<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use setasign\Fpdi\Fpdi;

class Pdflibrary extends FPDF
{
    public function __construct()
    {
        parent::__construct();
    }
}
