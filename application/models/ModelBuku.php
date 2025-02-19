<?php
class ModelBuku extends CI_Model
{
    //manajemen buku
    public function getbuku()
    {
        return $this->db->get('buku');
    }

    public function bukuWhere($where)
    {
        return $this->db->get_where($where, 'buku');
    }

    public function simpanBuku($data = null)
    {
        $this->db->insert('buku', $data);
    }

    public function updateBuku($data = null, $where = null)
    {
        $this->db->update('buku', $data, $where);
    }

    public function delete($where = null)
    {
        $this->db->delete('buku', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    //manajemen kategori

    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanData($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function upadateKategori($data = null, $where = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    public function hapuskategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    //join

    public function joinkategoriBuku($where)
    {
        $this->db->select('buku.id_kategori,kategori.kategori');
        $this->db->from('buku');
        $this->db->join('kategori', 'kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
}
