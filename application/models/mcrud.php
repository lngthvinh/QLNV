<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcrud extends CI_Model {

    protected $_table = 'employees';
    public function list_emp() 
    {
        // $this->db->order_by('fname');
        $query = $this->db->get($this->_table);
        return $query->result();
    }
    public function add_emp($emp) 
    {
        $data = array(
            'fname' => $emp['fname'],
            'lname' => $emp['lname'],
            'tel' => $emp['tel']
        );
        $result = $this->db->insert($this->_table, $data);
        return $result;
    }
    public function edit_emp($emp) 
    {
        $data = array(
            'fname' => $emp['fname'],
            'lname' => $emp['lname'],
            'tel' => $emp['tel']
        );
        $this->db->where('emp_id', $emp['id']);
        $result = $this->db->update($this->_table, $data);
        return $result;
    }
    public function del_emp($id) 
    {
        $this->db->where('emp_id', $id);
        $result = $this->db->delete($this->_table);
        return $result;
    }
}
