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
            $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('nama', 'Nama Produk', 'trim|required');
            $this->form_validation->set_rules('kode', 'Kode Produk', 'trim|required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi Produk', 'trim|required');
            $this->form_validation->set_rules('harga', 'Harga Produk', 'trim|required');
            $this->form_validation->set_rules('status', 'Status Produk', 'trim|required');
            $this->form_validation->set_rules('keyword', 'Keyword Produk', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Form tidak boleh ada yang kosong'
                ];
            } else {
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

    public function gambar($id)
    {
        if ($this->input->is_ajax_request()) {
            $produk = $this->produk_model->get($id);
            $gambar = $this->gambar_model->get_produk($id);
            $data = [
                'title' => 'Upload Gambar',
                'content'   => 'auth/produk/gambar',
                'produk'    => $produk,
                'gambar'    => $gambar
            ];
            $this->load->view('auth/template/modal', $data, FALSE);
        } else {

            redirect('auth/produk', 'refresh');
        }
    }

    public function hapus($id)
    {
        if ($this->input->is_ajax_request()) {
            $this->upload_config->hapus_produk($id);
            if (!$this->produk_model->hapus($id)) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Gagal menghapus data'
                ];
            } else {
                $data = [
                    'respond'   => 'success',
                    'title' => 'Berhasil!',
                    'message'   => 'Berhasil menghapus data'
                ];
            }
        } else {

            redirect('auth/produk', 'refresh');
        }
        echo json_encode($data);
    }

    public function h_edit($id)
    {
        if($this->input->is_ajax_request())
        {
            $produk = $this->produk_model->get($id);
            $kategori = $this->kategori_model->list();
            $data = [
                'title' => 'Edit '.$produk->nama,
                'content'   => 'auth/produk/edit',
                'produk'    => $produk,
                'kategori'  => $kategori
            ];
            $this->load->view('auth/template/modal', $data, FALSE);
            
        }else{
            redirect('auth/produk','refresh');
            
        }
    }

    public function p_edit($id)
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('id_kategori', 'Kategori', 'required');
            $this->form_validation->set_rules('nama', 'Nama Produk', 'trim|required');
            $this->form_validation->set_rules('kode', 'Kode Produk', 'trim|required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi Produk', 'trim|required');
            $this->form_validation->set_rules('harga', 'Harga Produk', 'trim|required');
            $this->form_validation->set_rules('status', 'Status Produk', 'trim|required');
            $this->form_validation->set_rules('keyword', 'Keyword Produk', 'trim|required');


            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Form tidak boleh ada yang kosong'
                ];
            } else {
                $post = $this->input->post();
                $post['slug'] = slug($post['nama']);

                $proses = $this->produk_model->update($id, $post);
                if ($proses) {
                    $data = [
                        'respond'   => 'success',
                        'title' => 'Berhasil!',
                        'message'   => 'Berhasil memperbarui data'
                    ];
                } else {
                    $data = [
                        'respond'   => 'error',
                        'title' => 'Gagal!',
                        'message'   => 'Gagal memperbarui data'
                    ];
                }
            }
        } else {

            redirect('auth/produk', 'refresh');
        }
        echo json_encode($data);
    }
}

/* End of file Controllername.php */
