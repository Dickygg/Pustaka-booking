<?php
class Autentifikasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelUser'); // Pastikan model sudah dipanggil di awal
    }
    public function index()
    {

        //jika status sudah login maka tidak bisa ke page login lagi alias balik ke page user
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim', [
            'required' => 'Email Harus DiIsi',
            'valid_email' => 'Email Salah!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password Harus DiIsi!',

        ]);
        if ($this->form_validation->run() == false) {
            $Title['judul'] = "Login";
            $data['user'] = '';
            $this->load->view('auth/head-auth', $Title);
            $this->load->view('auth/login');
            $this->load->view('auth/footer-auth');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = trim(htmlspecialchars($this->input->post('email', true)));
        $password = $this->input->post('password', true);
        $user = $this->db->get_where('user', ['email' => trim($email)])->row_array();
        // var_dump($user);
        // die;

        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                ///cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin');
                    } else {
                        if ($user['image'] == 'default.jpg') {
                            $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-massage" role="alert">Silakan Ubah Profile anda terlebih dahulu!</div>');
                        }
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-massage" role="alert">Password anda salah</div>');
                    redirect('Autentifikasi');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-massage" role="alert">Email tidak terdaftar!</div>');
                redirect('Autentifikasi');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Anda telah logout!</div>');
        redirect('autentifikasi');
    }


    public function blok()
    {
        $this->load->view('errors/blok/');
    }

    public function gagal()
    {
        $this->load->view('errors/gagal/');
    }

    ////registasi

    public function registrasi()
    {
        $this->load->model('modelUser');
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        //membuat rule utk inputan nama agar tidak boleh kosong dengan membuat pesan eror
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required', [
            'required' => 'Data Harus diisi'
        ]);
        //membuat rule email tidak boleh kosong,tidak ada spasi,format email harus valid dan belum pernah dipakai
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|trim|valid_email|is_unique[user.email]', [
            'valid_email' => 'Email Tidak benar',
            'required' => 'Email Tidak Boleh Kosong',
            'is_unique' => 'Email sudah terdaftar',
        ]);
        //  Buat aturan validasi password:

        // Tidak boleh kosong atau mengandung spasi.
        // Minimal 3 karakter.
        // Harus sama dengan repeat password.
        // Pesan error:

        // "Password Tidak Sama" jika tidak cocok.
        // "Password Terlalu Pendek" jika kurang dari 3 karakter.

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[1]|matches[password2]', [
            'min_length' => 'Password terlalu pendek',
            'matches' => 'Password Tidak Sama'
        ]);

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', []);

        if ($this->form_validation->run() == false) {
            $title['judul'] = 'Registrasi';
            $this->load->view('auth/head-auth', $title);
            $this->load->view('auth/registrasi');
            $this->load->view('auth/footer-auth');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'tanggal_input' => time()

            ];

            $this->modelUser->simpandata($data);

            $this->session->set_flashdata('pesan', '<div 
            class="alert alert-success alert-message" role="alert">Selamat!! 
            akun member anda sudah dibuat. Silahkan Aktivasi Akun anda</div>');
            redirect('autentifikasi');
        }
    }
}
