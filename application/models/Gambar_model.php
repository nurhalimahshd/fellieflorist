<?php


defined('BASEPATH') or exit('No direct script access allowed');

class gambar_model extends CI_Model
{

    public function get_produk($id)
    {
        $this->db->where('id_produk', $id);
        return $this->db->get('gambar_produk')->result();
    }

    public function get($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('gambar_produk')->row();
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('gambar_produk');
    }

   
}

/* End of file gambar_model.php */
