<?php


defined('BASEPATH') or exit('No direct script access allowed');

class upload extends CI_Controller
{

    public function gambarproduk($id)
    {
        if ($this->input->is_ajax_request()) {
            $folder = 'produk';


            $config['upload_path'] = './assets/img/upload/' . $folder . '/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']  = '4000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambarProduk')) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal',
                    'message' => $this->upload->display_errors()
                ];
            } else {
                $upload = $this->upload->data();

                $this->upload_config->config($upload, $folder);
                $gambar = [
                    'id_produk' => $id,
                    'file'        => $upload['file_name'],
                ];
                $this->db->insert('gambar_produk', $gambar);

                $data = [
                    'upload_data' => $upload,
                    'respond'   => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Gambar berhasil di-upload'

                ];
            }
            echo json_encode($data);
        }
    }

}

/* End of file upload.php */
