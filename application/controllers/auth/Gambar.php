<?php

defined('BASEPATH') or exit('No direct script access allowed');

class gambar extends CI_Controller
{

    public function hapus($id)
    {

        if ($this->input->is_ajax_request()) {
            $gambar = $this->gambar_model->get($id);
            $folder = 'produk';
            if (!$this->gambar_model->hapus($id)) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Gagal menghapus gambar!'
                ];
            } else {
                $this->upload_config->hapus_file($gambar->file, $folder);
                $data = [
                    'respond' => 'success',
                    'title' => 'Berhasil!',
                    'message'   => 'Berhasil menghapus gambar!'
                ];
            }
        } else {
            redirect('auth/produk', 'refresh');
        }
        echo json_encode($data);
    }

    public function set()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $id_produk = $this->input->post('id_produk');
            $data_gambar = $this->gambar_model->get($id);

            if (!$this->produk_model->update_gambar($id_produk, ['gambar'    => $data_gambar->file])) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => 'Terjadi kesalahan!'
                ];
            } else {
                $data = [
                    'respond'   => 'success',
                    'title' => 'Berhasil!',
                    'message'   => 'Berhasil ganti foto sampul produk'
                ];
            }
        } else {

            redirect('auth/produk', 'refresh');
        }
        echo json_encode($data);
    }
}

/* End of file gambar.php */
