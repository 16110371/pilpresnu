<?php
/**
 * CI3 PHP 8.2+ Compatibility Patch Script
 * Jalankan sekali di server atau local sebelum upload
 * Usage: php patch_ci3_php82.php /path/to/your/ci3/system
 */

$system_path = $argv[1] ?? './system';
$system_path = rtrim($system_path, '/');

if (!is_dir($system_path)) {
    die("ERROR: Folder tidak ditemukan: $system_path\n");
}

echo "==============================================\n";
echo " CI3 PHP 8.2+ Patch Tool\n";
echo "==============================================\n\n";

$patches = [
    // 1. core/URI.php - tambah $config property
    "$system_path/core/URI.php" => [
        [
            'find'    => 'class CI_URI {',
            'replace' => 'class CI_URI {' . "\n\t" . 'public $config;',
            'desc'    => 'URI.php: declare $config property',
        ]
    ],

    // 2. core/Router.php - tambah $uri property
    "$system_path/core/Router.php" => [
        [
            'find'    => 'class CI_Router {',
            'replace' => 'class CI_Router {' . "\n\t" . 'public $uri;',
            'desc'    => 'Router.php: declare $uri property',
        ]
    ],

    // 3. core/Controller.php - tambah semua dynamic properties
    "$system_path/core/Controller.php" => [
        [
            'find'    => 'class CI_Controller {',
            'replace' => 'class CI_Controller {' . "\n" .
                         "\t" . '// PHP 8.2+ compatibility: declare dynamic properties' . "\n" .
                         "\t" . 'public $benchmark;' . "\n" .
                         "\t" . 'public $hooks;' . "\n" .
                         "\t" . 'public $config;' . "\n" .
                         "\t" . 'public $log;' . "\n" .
                         "\t" . 'public $utf8;' . "\n" .
                         "\t" . 'public $uri;' . "\n" .
                         "\t" . 'public $exceptions;' . "\n" .
                         "\t" . 'public $router;' . "\n" .
                         "\t" . 'public $output;' . "\n" .
                         "\t" . 'public $security;' . "\n" .
                         "\t" . 'public $input;' . "\n" .
                         "\t" . 'public $lang;' . "\n" .
                         "\t" . 'public $load;',
            'desc'    => 'Controller.php: declare all dynamic properties',
        ]
    ],

    // 4. core/Loader.php - tambah dynamic properties untuk libraries & models
    "$system_path/core/Loader.php" => [
        [
            'find'    => 'class CI_Loader {',
            'replace' => 'class CI_Loader {' . "\n\t" . '// PHP 8.2+ handled via __set/__get in CI_Controller',
            'desc'    => 'Loader.php: note (controller handles dynamic props)',
        ]
    ],

    // 5. database/DB_driver.php - tambah $failover property
    "$system_path/database/DB_driver.php" => [
        [
            'find'    => 'class CI_DB_driver {',
            'replace' => 'class CI_DB_driver {' . "\n\t" . 'public $failover = array();',
            'desc'    => 'DB_driver.php: declare $failover property',
        ]
    ],

    // 6. libraries/Session/drivers/Session_files_driver.php - ReturnTypeWillChange
    "$system_path/libraries/Session/drivers/Session_files_driver.php" => [
        [
            'find'    => '	public function open($save_path, $name)',
            'replace' => '	#[\ReturnTypeWillChange]' . "\n" . '	public function open($save_path, $name)',
            'desc'    => 'Session_files_driver.php: add #[ReturnTypeWillChange] to open()',
        ],
        [
            'find'    => '	public function close()',
            'replace' => '	#[\ReturnTypeWillChange]' . "\n" . '	public function close()',
            'desc'    => 'Session_files_driver.php: add #[ReturnTypeWillChange] to close()',
        ],
        [
            'find'    => '	public function read($session_id)',
            'replace' => '	#[\ReturnTypeWillChange]' . "\n" . '	public function read($session_id)',
            'desc'    => 'Session_files_driver.php: add #[ReturnTypeWillChange] to read()',
        ],
        [
            'find'    => '	public function write($session_id, $session_data)',
            'replace' => '	#[\ReturnTypeWillChange]' . "\n" . '	public function write($session_id, $session_data)',
            'desc'    => 'Session_files_driver.php: add #[ReturnTypeWillChange] to write()',
        ],
        [
            'find'    => '	public function destroy($session_id)',
            'replace' => '	#[\ReturnTypeWillChange]' . "\n" . '	public function destroy($session_id)',
            'desc'    => 'Session_files_driver.php: add #[ReturnTypeWillChange] to destroy()',
        ],
        [
            'find'    => '	public function gc($maxlifetime)',
            'replace' => '	#[\ReturnTypeWillChange]' . "\n" . '	public function gc($maxlifetime)',
            'desc'    => 'Session_files_driver.php: add #[ReturnTypeWillChange] to gc()',
        ],
    ],
];

$total = 0;
$success = 0;
$skipped = 0;
$errors = 0;

foreach ($patches as $file => $file_patches) {
    if (!file_exists($file)) {
        echo "  [SKIP] File tidak ada: $file\n";
        continue;
    }

    // Backup file sebelum patch
    $backup = $file . '.bak';
    if (!file_exists($backup)) {
        copy($file, $backup);
        echo "  [BACKUP] $file\n";
    }

    $content = file_get_contents($file);

    foreach ($file_patches as $patch) {
        $total++;

        if (strpos($content, $patch['replace']) !== false) {
            echo "  [SKIP]   Sudah di-patch: {$patch['desc']}\n";
            $skipped++;
            continue;
        }

        if (strpos($content, $patch['find']) === false) {
            echo "  [WARN]   String tidak ditemukan: {$patch['desc']}\n";
            $errors++;
            continue;
        }

        $content = str_replace($patch['find'], $patch['replace'], $content);
        echo "  [OK]     {$patch['desc']}\n";
        $success++;
    }

    file_put_contents($file, $content);
}

echo "\n==============================================\n";
echo " Hasil: $success patch berhasil, $skipped sudah ada, $errors gagal\n";
echo "==============================================\n\n";

if ($errors > 0) {
    echo "Ada patch yang gagal. Cek manual file yang bersangkutan.\n";
    echo "Backup disimpan dengan ekstensi .bak\n\n";
} else {
    echo "Patch selesai! Upload folder system/ ke hosting Anda.\n\n";
}
