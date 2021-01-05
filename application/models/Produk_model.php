<?php

defined('BASEPATH') or exit('No direct script access allowed');

class produk_model extends CI_Model
{

    public function list()
    {
        $this->db->select('produk.*, kategori.nama AS kategori, produk_status.nama AS status');
        $this->db->join('kategori', 'kategori.id = produk.id_kategori', 'left');
        $this->db->join('produk_status', 'produk_status.id = produk.status', 'left');
        return $this->db->get('produk')->result();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('produk')->row();
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

    public function update_gambar($id_produk, $data)
    {
        $this->db->where('id', $id_produk);
        return $this->db->update('produk', $data);
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('produk');   
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('produk', $data);
        
        
    }
}

/* End of file produk_model.php */
