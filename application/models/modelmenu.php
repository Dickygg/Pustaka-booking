<?php
class modelmenu extends CI_Model
{
    public function tampil()
    {
        return $this->db->get('menumakan');
    }

    public function delete($kd_menu)
    {
        $this->db->where('kd_menu', $kd_menu);
        return $this->db->delete('menumakan');
    }

    public function proses_tambahmenu($data)
    {

        $this->db->insert('menumakan', $data);
    }

    public function getmenu_byid($kd_menu)
    {
        return $this->db->get_where('menumakan', ['kd_menu' => $kd_menu])->row();
    }

    public function updatemenu($kd_menu, $data)
    {
        $this->db->where('kd_menu', $kd_menu);
        return $this->db->update('menumakan', $data);
    }
}
