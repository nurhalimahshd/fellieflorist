<?php


defined('BASEPATH') or exit('No direct script access allowed');

class login extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Login Admin'
        ];
        $this->load->view('auth/login/list', $data, FALSE);
    }

    public function proses()
    {
        if ($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email',[
                'valid_email'   => 'Email tidak valid',
                'required'  => 'Masukkan email'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'trim|required',[
                'required'  => 'Masukkan password'
            ]);


            if ($this->form_validation->run() == FALSE) {
                $data = [
                    'respond'   => 'error',
                    'title' => 'Gagal!',
                    'message'   => validation_errors(),
                    'icon'  => 'error'
                ];
            } else {

                $email = $this->input->post('email');
                $password = MD5($this->input->post('password'));

                $get = $this->db->get_where('auth_user', [
                    'email'  => $email
                ])->row();

                if ($get) {
                    if ($get->password == $password) {
                        $array = array(
                            'email' => $get->email,
                            'nama' => $get->nama,
                            'status'    => 'login'
                        );

                        $this->session->set_userdata($array);
                        $data = [
                            'respond'   => 'success',
                            'title' => 'Berhasil!',
                            'message'   => 'Anda berhasil login!'
                        ];
                    } else {
                        $data = [
                            'respond'   => 'error',
                            'title' => 'Gagal!',
                            'message'   => 'Password salah!'
                        ];
                    }
                } else {
                    $data = [
                        'respond'   => 'error',
                        'title' => 'Gagal!',
                        'message'   => 'User tidak ditemukan!'
                    ];
                }
            }
        } else {
            redirect(base_url('auth/login'), 'refresh');
        }
        echo json_encode($data);
    }

    public function h_logout()
    {
        if ($this->input->is_ajax_request()) {

            $data = [
                'title' => 'Logout',
                'content' => 'auth/login/logout'
            ];
            $this->load->view('auth/template/modal', $data, FALSE);
        }
    }

    public function logout()
    {
        if ($this->input->is_ajax_request()) {

            $this->session->sess_destroy();

            $data = [
                'respond'   => 'success',
                'message'   => 'Anda berhasil logout!'
            ];

            echo json_encode($data);
        }
    }
}

/* End of file login.php */
