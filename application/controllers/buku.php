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
        $data['kategori'] = $this->modelBuku->getKategori()->result_array();
        $this->form_validation->set_rules('judul_buku', 'judul buku', 'required|min_length[3]', [
            'required' => 'judul harus diisi',
            'min_length' => 'judul buku terlalu pendek'
        ]);

        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'kategori harus diisi'
        ]);
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[3]', [
            'required' => 'pengarang harus diisi',
            'min_length' => 'Pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[3]', [
            'required' => 'penerbit harus diisi',
            'min_length' => 'Nama Penerbit Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('tahun_terbit', 'Tahun', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun Harus diisi',
            'min_length' => 'tahun terlalu pendek',
            'max_length' => 'tahun terlalu panjang',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('isbn', 'ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Tahun Harus diisi',
            'min_length' => 'ISBN Terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        $this->form_validation->set_rules('stok', 'STOK', 'required|numeric', [
            'required' => 'Tahun Harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        ////konfigurasi gambar
        $config['upload_path'] = './assets/sbadmin/img/upload/'; //folder upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 3000; ///maksimal 2mb
        $config['max_width'] = 1024;
        $config['max_height'] = 1000;
        $config['encrypt_name'] = true; //nama dienkripsi agar unik

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('tamplate/view-header', $title);
            $this->load->view('tamplate/view-sidebar', $user);
            $this->load->view('tamplate/view-topbar', $user);
            $this->load->view('daftarbuku', $data,);
            $this->load->view('tamplate/view-footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }

            $data = [
                'judul_buku' => $this->input->post('judul_buku', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit' => $this->input->post('penerbit', true),
                'tahun_terbit' => $this->input->post('tahun_terbit', true),
                'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'dibooking' => 0,
                'dipinjam' => 0,
                'image' => $gambar
            ];
            $this->modelBuku->simpanBuku($data);
            redirect('buku');
        }
    }

    public function delete()
    {
        $this->load->model('modelBuku');
        $where = ['id' => $this->uri->segment(3)];
        $this->modelBuku->delete($where);
        redirect('buku');
    }


    public function updateBuku()
    {
        $this->load->model('modelBuku');
        $this->load->model('modelUser'); // Pastikan model sudah dipanggil di awal
        $title['judul'] = 'Daftar Buku';
        $user['user'] = $this->modelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->modelBuku->bukuWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->modelBuku->joinkategoriBuku(['buku.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->modelBuku->getKategori()->result_array();

        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'kategori harus diisi'
        ]);
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|min_length[3]', [
            'required' => 'pengarang harus diisi',
            'min_length' => 'Pengarang terlalu pendek'
        ]);
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required|min_length[3]', [
            'required' => 'penerbit harus diisi',
            'min_length' => 'Nama Penerbit Terlalu Pendek'
        ]);
        $this->form_validation->set_rules('tahun_terbit', 'Tahun', 'required|min_length[3]|max_length[4]|numeric', [
            'required' => 'Tahun Harus diisi',
            'min_length' => 'tahun terlalu pendek',
            'max_length' => 'tahun terlalu panjang',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);
        $this->form_validation->set_rules('isbn', 'ISBN', 'required|min_length[3]|numeric', [
            'required' => 'Tahun Harus diisi',
            'min_length' => 'ISBN Terlalu pendek',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        $this->form_validation->set_rules('stok', 'STOK', 'required|numeric', [
            'required' => 'Tahun Harus diisi',
            'numeric' => 'Yang anda masukan bukan angka'
        ]);

        ////konfigurasi gambar
        $config['upload_path'] = './assets/sbadmin/img/upload/'; //folder upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 3000; ///maksimal 2mb
        $config['max_width'] = 1024;
        $config['max_height'] = 1000;
        $config['encrypt_name'] = true; //nama dienkripsi agar unik

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('tamplate/view-header', $title);
            $this->load->view('tamplate/view-sidebar', $user);
            $this->load->view('tamplate/view-topbar', $user);
            $this->load->view('view-editbuku', $data,);
            $this->load->view('tamplate/view-footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }

            $data = [
                'judul_buku' => $this->input->post('judul_buku', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'pengarang' => $this->input->post('pengarang', true),
                'penerbit' => $this->input->post('penerbit', true),
                'tahun_terbit' => $this->input->post('tahun_terbit', true),
                'isbn' => $this->input->post('isbn', true),
                'stok' => $this->input->post('stok', true),
                'dibooking' => 0,
                'dipinjam' => 0,
                'image' => $gambar
            ];
            $this->modelBuku->updateBuku($data, ['id' => $this->input->post('id')]);
            redirect('buku');
        }
    }
}
