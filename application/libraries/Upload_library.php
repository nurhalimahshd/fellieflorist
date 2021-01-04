<?php


defined('BASEPATH') or exit('No direct script access allowed');

class upload_library
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->library('image_lib');
    }

    function hapus_file($folder, $file)
    {
        if ($file != 'default.png') {

            $file1 = 'assets/img/upload/' . $folder . '/' . $file;
            $file2 = 'assets/img/upload/' . $folder . '/thumbs/' . $file;
            $file3 = 'assets/img/upload/' . $folder . '/thumbs/cropped/' . $file;
            $file4 = 'assets/img/upload/' . $folder . '/cropped/' . $file;

            if (file_exists($file1)) {
                unlink($file1);
            }
            if (file_exists($file2)) {
                unlink($file2);
            }
            if (file_exists($file3)) {
                unlink($file3);
            }
            if (file_exists($file4)) {
                unlink($file4);
            }
        }
    }

    function config($folder, $data)
    {
        $file = $data['file_name'];
        $filesize = getimagesize($data['full_path']);
        $config2['image_library'] = 'gd2';
        $config2['source_image']     = './assets/img/upload/' . $folder . '/' . $file;
        $config2['new_image']        = './assets/img/upload/' . $folder . '/cropped/';
        $config2['maintain_ratio']     = false;

        if ($filesize[0] > $filesize[1]) {
            $config2['width'] = $filesize[1];
            $config2['height'] = $filesize[1];
            $config2['x_axis'] = ($filesize[0] - $filesize[1]) / 2;
            $config2['y_axis'] = 0;
        } else {
            $config2['width'] = $filesize[0];
            $config2['height'] = $filesize[0];
            $config2['y_axis'] = ($filesize[1] - $filesize[0]) / 2;
            $config2['x_axis'] = 0;
        }
        $this->ci->image_lib->initialize($config2);
        $this->ci->image_lib->crop();
        // crop thumbnail

        // buat thumbnail
        $config['image_library']     = 'gd2';
        $config['source_image']     = './assets/img/upload/' . $folder . '/' . $file;
        $config['new_image']        = './assets/img/upload/' . $folder . '/thumbs/';
        $config['maintain_ratio']     = true;
        $config['width']            = 250;
        $this->ci->image_lib->initialize($config);
        $this->ci->image_lib->resize();
        // batas thumbnail

        // buat thumbnail 2
        $config3['image_library']     = 'gd2';
        $config3['source_image']     = './assets/img/upload/' . $folder . '/cropped/' . $file;
        $config3['new_image']        = './assets/img/upload/' . $folder . '/thumbs/cropped/';
        $config3['maintain_ratio']     = true;
        $config3['width']            = 250;
        $this->ci->image_lib->initialize($config3);
        $this->ci->image_lib->resize();
    }
}

/* End of file LibraryName.php */
