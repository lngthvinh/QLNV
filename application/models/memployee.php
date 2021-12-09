<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memployee extends CI_Model {

    protected $_table = 'employees';
    public function list_emp() 
    {
        $this->db->select('emp_id, fname, lname, job');
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }
    public function count_emp() 
    {
    }
    public function add_emp($emp) 
    {
        $data = array(
            'fname' => $emp['fname'],
            'lname' => $emp['lname'],
            'job' => $emp['job']
        );
        $this->db->insert($this->_table, $data);
    }
    public function get_emp($id) 
    {
        $this->db->where("emp_id", $id);
        $query = $this->db->get($this->_table);
        return $query->row_array();
    }
    public function edit_emp($id, $emp) 
    {
        $data = array(
            'fname' => $emp['fname'],
            'lname' => $emp['lname'],
            'job' => $emp['job']
        );
        $this->db->where('emp_id', $id);
        $this->db->update($this->_table, $data);
    }
    public function del_emp($id) 
    {
        $this->db->where('emp_id', $id);
        $this->db->delete($this->_table);
    }
}
