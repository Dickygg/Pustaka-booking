<?php
class ModelUser extends CI_Model
{
    public function simpandata($data = null)
    {
        $this->db->insert('user', $data);
    }

    public function cekData($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function getUserWhere($where = null)
    {
        return $this->db->get_where('user', $where);
    }

    public function cekUserAcces($where = null)
    {
        $this->db->select('*');
        $this->db->from('access_menu');
        $this->db->where($where);
        return $this->db->get();
    }


    public function getUserLimit()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(10, 0);
        return $this->db->get();
    }
}
