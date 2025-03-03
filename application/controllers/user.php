<?php
class user extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('modelBuku');
        cek_login();
    }

    public function index()
    {
        $this->load->model('modelBuku');
        $this->load->model('modelUser');
        $title['judul'] = 'Anggota';
        $user['user'] = $this->modelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $this->db->where('role_id', 1);
        $data['anggota'] = $this->modelUser->cekData()->result_array();


        $this->load->view('tamplate/view-header', $title);
        $this->load->view('tamplate/view-sidebar', $user);
        $this->load->view('tamplate/view-topbar', $user);
        $this->load->view('user/anggota', $data);
        $this->load->view('tamplate/view-footer');
    }
}
