<?php
class Web extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // $this->load->helper('url');
    }

    function index()
    {
        $data['judul'] = "Halaman Depan";
        $this->load->view('v-header');
        $this->load->view('v-index', $data);
        $this->load->view('v-footer');
    }

    function about()
    {
        $data['judul'] = "Halaman About";
        $this->load->view('v-header');
        $this->load->view('v-about', $data);
        $this->load->view('v-footer');
    }
}
