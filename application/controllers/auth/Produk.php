<?php


defined('BASEPATH') or exit('No direct script access allowed');

class produk extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'content'   => 'auth/produk/list'
        ];
        $this->load->view('auth/template/list', $data, FALSE);
    }

    public function h_tambah()
    {
        if ($this->input->is_ajax_request()) {
            $kategori = $this->kategori_model->list();
            $data = [
                'title' => 'Tambah Produk',
                'content'   => 'auth/produk/tambah',
                'kategori'  => $kategori
            ];
            $this->load->view('auth/template/modal', $data, FALSE);
        } else {

            redirect('auth/produk', 'refresh');
        }
    }

    public function p_tambah()
    {
        if ($this->input->is_ajax_request()) {
            $post = $this->input->post();
            $post['slug'] = slug($post['nama']);

            $proses = $this->produk_model->input($post);
            if ($proses) {
                $data = [
                    'respond'   => 'success',
                    'title' => 'Berhasil!',
                    'message'   => 'Berhasil menambahkan data'
                ];
            } else {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Gagal menambahkan data'
                ];
            }
        } else {

            redirect('auth/produk', 'refresh');
        }
        echo json_encode($data);
    }

    public function list()
    {
        $data = $this->produk_model->list();
        print_r($data);
    }

    public function table()
    {
        if ($this->input->is_ajax_request()) {
            $produk = $this->produk_model->list();
            $data = [
                'produk'    => $produk
            ];
            $this->load->view('auth/produk/table', $data, FALSE);
        } else {

            redirect('auth/produk', 'refresh');
        }
    }
}

/* End of file Controllername.php */
