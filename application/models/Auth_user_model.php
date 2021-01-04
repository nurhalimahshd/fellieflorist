<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class auth_user_model extends CI_Model {

    public function get($email)
    {
        $this->db->where('email', $email);        
        return $this->db->get('auth_user')->row();
        
    }

    

}

/* End of file auth_user.php */
