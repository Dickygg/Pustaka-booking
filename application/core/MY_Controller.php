<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        // Bisa load helper / library global di sini kalau mau
        // $this->load->helper('url');
        // $this->load->library('session');
    }

    // Function cek login global
    public function cek_login(){
        if (!$this->session->userdata('email')) {
            // Kalau belum login, redirect ke auth
            $this->session->set_flashdata('pesan', 
                '<div class="alert alert-danger" role="alert">
                Silakan login terlebih dahulu!
                </div>');
            redirect('auth');
        }
    }

    // Function buat cek role, misal cek admin
    public function cek_admin(){
        if ($this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('pesan', 
                '<div class="alert alert-danger" role="alert">
                Akses ditolak! Bukan admin.
                </div>');
            redirect('auth');
        }
    }

    // Function buat cek pengguna biasa
    public function cek_pengguna(){
        if ($this->session->userdata('role') != 'pengguna') {
            $this->session->set_flashdata('pesan', 
                '<div class="alert alert-danger" role="alert">
                Akses ditolak! Bukan pengguna.
                </div>');
            redirect('auth');
        }
    }

    // Function redirect otomatis sesuai role
    public function redirect_by_role(){
        if ($this->session->userdata('role') == 'admin') {
            redirect('admin/dashboard');
        } elseif ($this->session->userdata('role') == 'pengguna') {
            redirect('pengguna/user');
        } else {
            redirect('auth');
        }
    }
}
