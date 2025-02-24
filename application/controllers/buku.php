<?php
class buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('modelBuku');
        cek_login();
    }

    public function index()
    {
        $this->load->model('modelUser'); // Pastikan model sudah dipanggil di awal
        $this->load->model('modelBuku');
        $title['judul'] = 'Daftar Buku';
        $user['user'] = $this->modelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->modelBuku->getbuku()->result_array();
        $kategori['kategori'] = $this->modelBuku->getKategori()->result_array();



        $this->load->view('tamplate/view-header', $title);
        $this->load->view('tamplate/view-sidebar', $user);
        $this->load->view('tamplate/view-topbar', $user);
        $this->load->view('daftarbuku', $data, $kategori);
        $this->load->view('tamplate/view-footer');
    }

    public function delete()
    {
        $this->load->model('modelBuku');
        $where = ['id' => $this->uri->segment(3)];
        $this->modelBuku->delete($where);
        redirect('buku');
    }
}
