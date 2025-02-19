<?php
class matakuliah extends CI_Controller
{
    public function index()
    {
        $this->load->view('tamplate/view-header');
        $this->load->view('view-matakuliah');
        $this->load->view('tamplate/view-footer');
    }

    public function cetak()
    {
        $this->form_validation->set_rules('kode', 'kode MataKuliah', 'required|min_length[3]', [
            'required' => 'Kode Mata Kuliah Harus DiIsi.',
            'min_length' => 'kode Terlalu pendek'
        ]);

        $this->form_validation->set_rules('nama', 'Nama MataKuliah', 'required|min_length[3]', [
            'required' => 'Nama Matakuliah Harus Diisi.',
            'min_length' => 'Nama Teralu Pendek'
        ]);

        if ($this->form_validation->run() != true) {

            $this->load->view('view-matakuliah');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => $this->input->post('nama'),
                'sks' => $this->input->post('sks')

            ];

            $this->load->view('view-data-matakuliah', $data);
        }
    }
}
