<?php
class siswa extends CI_Controller
{

    public function index()
    {
        $Title['Title'] = "Siswa";
        $this->load->model('Modelsiswa');
        $data['siswa'] = $this->Modelsiswa->tampil();
        $this->load->view('tamplate/view-header', $Title);
        $this->load->view('view-siswa', $data);
        $this->load->view('tamplate/view-footer');
    }

    public function tambahdata()
    {
        $Title['Title'] = "Tambah Siswa";
        $this->load->view('tamplate/view-header', $Title);
        $this->load->view('view-tambahsiswa');
        $this->load->view('tamplate/view-footer');
    }

    public function proses_tambahsiswa()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'nis' => $this->input->post('nis'),
            'kelas' => $this->input->post('kelas'),
            'tanggal' => $this->input->post('tanggal'),
            'alamat' => $this->input->post('alamat'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'agama' => $this->input->post('agama')
        ];
        $this->load->model('Modelsiswa');
        $this->Modelsiswa->proses_tambahsiswa($data);
        redirect('siswa');
    }

    public function delete($kd_siwa = null)
    {
        if ($kd_siwa === null) {
            show_404(); // Tampilkan error 404 jika parameter kosong
        }

        $this->load->model('Modelsiswa');

        // Periksa apakah data dengan ID tersebut ada
        $cek = $this->Modelsiswa->siswaWhere(['kd_siwa' => $kd_siwa])->row();
        if (!$cek) {
            show_404(); // Jika data tidak ditemukan, tampilkan error 404
        }

        // Hapus data
        $this->Modelsiswa->delete(['kd_siwa' => $kd_siwa]);

        // Redirect kembali ke halaman siswa
        redirect('siswa');
    }
}
