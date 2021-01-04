<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {

    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'content'   => 'auth/dashboard/list'
        ];
        $this->load->view('auth/template/list', $data, FALSE);
        
    }

}

/* End of file Dashboard.php */
