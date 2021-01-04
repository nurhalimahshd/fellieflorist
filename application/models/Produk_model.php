<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class produk_model extends CI_Model {

    public function list()
    {
        $this->db->select('produk.*, kategori.nama AS kategori, produk_status.nama AS status');        
        $this->db->join('kategori', 'kategori.id = produk.id_kategori', 'left');        
        $this->db->join('produk_status', 'produk_status.id = produk.status', 'left');        
        return $this->db->get('produk')->result();
        
    }

    public function get_kategori($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('kategori')->row();
        
        
    }

    public function input($data)
    {
        return $this->db->insert('produk', $data);
        
    }

    

}

/* End of file produk_model.php */
