<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class auth_menu_model extends CI_Model {

    public function list()
    {
        return $this->db->get('auth_menu')->result();
        
    }
    

}

/* End of file ModelName.php */
