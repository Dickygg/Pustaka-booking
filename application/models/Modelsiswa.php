<?php
class Modelsiswa extends CI_Model
{
    public function tampil()
    {
        return $this->db->get('siswa')->result();
    }

    public function proses_tambahsiswa($data = null)
    {
        return $this->db->insert('siswa', $data);
    }

    public function siswaWhere($where)
    {
        return $this->db->get_where('siswa', $where);
    }

    public function delete($where = null)
    {
        $this->db->delete('siswa', $where);
    }
}
