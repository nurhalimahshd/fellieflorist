<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class produk extends CI_Controller {

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'content'   => 'auth/produk/list'
        ];
        $this->load->view('auth/template/list', $data, FALSE);
        
    }

}

/* End of file Controllername.php */
