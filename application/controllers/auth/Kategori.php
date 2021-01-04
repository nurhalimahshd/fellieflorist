<?php


defined('BASEPATH') or exit('No direct script access allowed');

class kategori extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'content'   => 'auth/kategori/list'
        ];
        $this->load->view('auth/template/list', $data, FALSE);
    }

    public function table()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'kategori'  => $this->kategori_model->list()
            ];
            $this->load->view('auth/kategori/table', $data, FALSE);
        } else {
            redirect('auth/kategori', 'refresh');
        }
    }

    public function h_tambah()
    {
        if ($this->input->is_ajax_request()) {
            $data = [
                'title' => 'Tambah Kategori',
                'content'   => 'auth/kategori/tambah'
            ];
            $this->load->view('auth/template/modal', $data, FALSE);
        } else {

            redirect('auth/kategori', 'refresh');
        }
    }

    public function p_tambah()
    {
        if ($this->input->is_ajax_request()) {
            $nama = $this->input->post('nama');
            $post = [
                'slug'  => slug($nama),
                'nama'  => $nama
            ];

            $proses = $this->kategori_model->input($post);
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
            redirect('auth/kategori', 'refresh');
        }
        echo json_encode($data);
    }

    public function hapus($id)
    {
        if ($this->input->is_ajax_request()) {
            $proses = $this->kategori_model->hapus($id);
            if ($proses) {
                $data = [
                    'respond'   => 'success',
                    'title' => 'Berhasil!',
                    'message'   => 'Berhasil menghapus data'
                ];
            } else {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Gagal menghapus data'
                ];
            }
        } else {
            redirect('auth/kategori', 'refresh');
        }
        echo json_encode($data);
    }

    public function h_edit($id)
    {
        if($this->input->is_ajax_request()){
            $kategori = $this->kategori_model->get($id);
            $data = [
                'title' => 'Edit Kategori '.$kategori->nama,
                'content'   => 'auth/kategori/edit',
                'kategori'  => $kategori
            ];
            $this->load->view('auth/template/modal', $data, FALSE);
            
        }else{
            redirect('auth/kategori', 'refresh');
        }
    }

    public function p_edit($id)
    {
        if ($this->input->is_ajax_request()) {
            $nama = $this->input->post('nama');
            $post = [
                'slug'  => slug($nama),
                'nama'  => $nama
            ];

            $proses = $this->kategori_model->edit($id, $post);
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
        } else {
            redirect('auth/kategori', 'refresh');
        }
        echo json_encode($data);
    }
}

/* End of file kategori.php */
