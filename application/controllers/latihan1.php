<?php
defined('BASEPATH') or exit('No direct script access allowed');

class latihan1 extends CI_Controller
{
    public function index()
    {
        echo "Selamat Datang....Selamat Belajar Wepro II";
    }

    public function penjumlahan($n1, $n2)
    {
        $this->load->model('modellatihan1');
        $data['nilai1'] = $n1;
        $data['nilai2'] = $n2;
        $data['hasil'] = $this->modellatihan1->jumlah($n1, $n2);
        $this->load->view('view-latihan1', $data);
    }
}
