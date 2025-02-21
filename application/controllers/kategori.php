<?php
class kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelBuku');
        $this->load->model('ModelUser');
    }

    public function index()
    {
        $this->load->model('modelUser');
        $this->load->model('modelBuku');

        $title['judul'] = 'kategori';
        $user['user'] = $this->modelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->modelBuku->getKategori()->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Judul Buku Harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('tamplate/view-header', $title);
            $this->load->view('tamplate/view-sidebar', $user);
            $this->load->view('tamplate/view-topbar', $user);
            $this->load->view('view-kategori', $data);
            $this->load->view('tamplate/view-footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];
            $this->modelBuku->simpanData($data);
            redirect('kategori');
        }
    }

    public function hapuskategori()
    {
        $this->load->model('modelBuku');
        $where = ['id' => $this->uri->segment(3)];
        $this->modelBuku->hapuskategori($where);
        redirect('kategori');
    }
}
