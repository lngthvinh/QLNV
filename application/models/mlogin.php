<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mlogin extends CI_Model {

    protected $_table = 'users';
    public function check_user($user)
    {
        $condition = array(
            'username' => $user['username'], 
            'password' => $user['password']
        );
        $query = $this->db->get_where($this->_table, $condition);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function add_user($user)
    {
        $data = array(
            'username' => $user['username'], 
            'password' => $user['password']
        );
        $this->db->insert($this->_table, $data);
    }
}
