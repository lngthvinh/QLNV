<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memployee extends CI_Model {

    protected $_table = 'employees';
    public function list_employee() 
    {
        // $this->db->order_by('firstName');
        $query = $this->db->get($this->_table);
        return $query->result();
    }
    public function add_employee($employee) 
    {
        $data = array(
            'firstName' => $employee['firstName'],
            'lastName' => $employee['lastName'],
            'telephone' => $employee['telephone']
        );
        $this->db->insert($this->_table, $data);
        $insert_id = $this->db->insert_id();
        // Check added
        $query = $this->db->get_where($this->_table, array('employeeId' => $insert_id));
        return $query->row();
    }
    public function edit_employee($employee) 
    {
        $data = array(
            'firstName' => $employee['firstName'],
            'lastName' => $employee['lastName'],
            'telephone' => $employee['telephone']
        );
        $this->db->where('employeeId', $employee['id']);
        $this->db->update($this->_table, $data);
        // Check edited
        $query = $this->db->get_where($this->_table, array('employeeId' => $employee['id']));
        return $query->row();
    }
    public function del_employee($id) 
    {
        $this->db->where('employeeId', $id);
        $this->db->delete($this->_table);
        // Check deleted
        $query = $this->db->get_where($this->_table, array('employeeId' => $id));
        return $query->row();
    }
}
