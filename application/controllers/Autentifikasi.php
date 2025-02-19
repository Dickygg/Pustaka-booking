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
}
