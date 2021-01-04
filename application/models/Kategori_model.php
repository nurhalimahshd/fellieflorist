<?php


defined('BASEPATH') or exit('No direct script access allowed');

class kategori_model extends CI_Model
{

    public function list()
    {
        return $this->db->get('kategori')->result();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('kategori')->row();        
        
    }

    public function get_produk($id)
    {
        $this->db->where('id_kategori', $id);
        return $this->db->get('produk')->result_array();
    }

    public function input($data)
    {
        return $this->db->insert('kategori', $data);
        
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('kategori');
        
        
    }

    public function edit($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('kategori', $data);
        
        
    }
}

/* End of file kategori_model.php */
