<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

date_default_timezone_set("Asia/Jakarta");

use PhpOffice\PhpSpreadsheet\IOFactory;

class Import extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->db->query("SET time_zone='+7:00'");
    }

    public function siswa()
    {
        if (empty($_FILES['import_excel']['name'])) {
            $this->session->set_flashdata('error', 'File belum dipilih.');
            return redirect('admin/datadpt');
        }

        $fileName = $_FILES['import_excel']['name'];
        $fileTmp  = $_FILES['import_excel']['tmp_name'];
        $ext      = pathinfo($fileName, PATHINFO_EXTENSION);

        // Validasi tipe file
        if (!in_array($ext, ['xls', 'xlsx'])) {
            $this->session->set_flashdata('error', 'File harus berformat xls atau xlsx.');
            return redirect('admin/datadpt');
        }

        try {
            $spreadsheet = IOFactory::load($fileTmp);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow();

            $success = 0;
            $errors  = [];

            $this->db->trans_start();

            for ($row = 2; $row <= $highestRow; $row++) {

                $username = trim($sheet->getCell("A$row")->getValue());
                $password = trim($sheet->getCell("B$row")->getValue());
                $nm_siswa = trim($sheet->getCell("C$row")->getValue());
                $jk       = strtoupper(trim($sheet->getCell("D$row")->getValue()));
                $kd_kelas = trim($sheet->getCell("E$row")->getValue());
                $role     = strtolower(trim($sheet->getCell("F$row")->getValue()));

                if ($username == "" || $nm_siswa == "") {
                    continue;
                }

                // Validasi JK
                if (!in_array($jk, ['L', 'P'])) {
                    $errors[] = "Baris $row: JK harus L atau P";
                    continue;
                }

                // Validasi Role
                if (!in_array($role, ['siswa', 'dpp'])) {
                    $errors[] = "Baris $row: Role harus siswa atau dpp";
                    continue;
                }

                // Cek kelas
                $cek_kelas = $this->db
                    ->where('kd_kelas', $kd_kelas)
                    ->get('tb_kelas')
                    ->row();

                if (!$cek_kelas) {
                    $errors[] = "Baris $row: Kelas tidak ditemukan";
                    continue;
                }

                // Cek username duplikat
                $cek_user = $this->db
                    ->where('username', $username)
                    ->get('tb_siswa')
                    ->row();

                if ($cek_user) {
                    $errors[] = "Baris $row: Username sudah ada";
                    continue;
                }

                $data = [
                    'username'  => $username,
                    'password'  => $password, // masih plain sesuai sistem login
                    'nm_siswa'  => $nm_siswa,
                    'jk'        => $jk,
                    'kd_kelas'  => $kd_kelas,
                    'hadir'     => 'Tidak Hadir',
                    'role'      => $role
                ];

                $this->db->insert('tb_siswa', $data);
                $success++;
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
            } else {
                $this->session->set_flashdata('success', "$success data berhasil diimport.");
                if (!empty($errors)) {
                    $this->session->set_flashdata('error', implode('<br>', $errors));
                }
            }
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'File tidak valid atau rusak.');
        }

        redirect('admin/datadpt');
    }

    public function download_template()
    {
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=template_upload_data.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo "username\tpassword\tnm_siswa\tjk\tkd_kelas\trole\n";
        echo "1001\t1001\tAhmad Ma'ruf\tL\t1\tsiswa\n";
        echo "1002\t1002\tAisyah N\tP\t2\tsiswa\n";
        echo "1234\t1234\tUstadz Fulan\tL\t12\tdpp\n";
    }
}
