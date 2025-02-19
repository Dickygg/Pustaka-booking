<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('ModelUser');
        $this->load->model('modelBuku');
    }


    public function index()
    {
        $data['judul'] = 'Dashboard Admin';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['anggota'] = $this->ModelUser->getUserLimit()->result_array();
        $data['buku'] = $this->modelBuku->getbuku()->result_array();

        $this->load->view('tamplate/view-header', $data);
        $this->load->view('tamplate/view-sidebar', $data);
        $this->load->view('tamplate/view-topbar', $data);
        $this->load->view('view-index', $data);
        $this->load->view('tamplate/view-footer');
    }
}
