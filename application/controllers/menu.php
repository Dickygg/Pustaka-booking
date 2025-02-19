<?php
class menu extends CI_Controller
{
    public function index()
    {

        $title['Title'] = "Menu";
        $this->load->model('modelmenu');
        $data['menu'] = $this->modelmenu->tampil()->result();
        $this->load->view('tamplate/view-header', $title);
        $this->load->view('view-menu', $data);
        $this->load->view('tamplate/view-footer');
    }

    public function tambahmenu()
    {
        $this->load->view('tamplate/view-header');
        $this->load->view('view-tambah-menu');
        $this->load->view('tamplate/view-footer');
    }

    public function proses_tambahmenu()
    {
        $this->load->model('modelmenu');
        $config['upload_path'] = './uploads/'; //folder upload
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; ///maksimal 2mb
        $config['encrypt_name'] = true; //nama dienkripsi agar unik
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            //jika berhasil upload
            $uploadData = $this->upload->data();
            $gambar = $uploadData['file_name'];
        } else {
            //jika gagal upload
            $gambar = 'default.png';
        }

        //data yang disimpan ke data base
        $data = [
            "mmmenu" => $this->input->post('mmmenu', true),
            "harga" => (float)$this->input->post('harga'),
            "gambar" => $gambar
        ];
        $this->modelmenu->proses_tambahmenu($data);
        redirect('menu');
    }

    public function delete($kd_menu)
    {
        $this->load->model('modelmenu');
        if ($this->modelmenu->delete($kd_menu)) {
            $this->session->set_flashdata('success', "menu berhasil di hapus");
            redirect('menu');
        } else {
            $this->session->set_flashdata('error', "gagal mengahpus data");
            redirect('menu');
        }
    }

    public function editdata($kd_menu)
    {
        $this->load->model('modelmenu');
        $data['menu'] = $this->modelmenu->getmenu_byid($kd_menu);
        $this->load->view('tamplate/view-header');
        $this->load->view('view-edit-menu', $data);
        $this->load->view('tamplate/view-footer');
    }

    public function prosesedit()
    {
        $this->load->model('modelmenu');
        $kd_menu = $this->input->post('kd_menu');

        $menulama = $this->modelmenu->getmenu_byid($kd_menu); //ambil data menu lama    
        $data = [
            "mmmenu" => $this->input->post('mmmenu', true),
            "harga" => (float)$this->input->post('harga'),
        ];



        if (!empty($_FILES['gambar']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                ////hapus gambar lama jika ada
                if (!empty($menulama->gambar) && file_exists('./uploads/' . $menulama->gambar)) {
                    unlink('./uploads/' . $menulama->gambar);
                }

                $uploadData = $this->upload->data();
                $data['gambar'] = $uploadData['file_name']; //simpan file baru
            } else {
                echo $this->upload->display_errors();
                return;
            }
        }

        $this->modelmenu->updatemenu($kd_menu, $data);
        redirect('menu');
    }
}
