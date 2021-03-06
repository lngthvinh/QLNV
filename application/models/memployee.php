<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memployee extends CI_Model {

    protected $_table = 'employees';
    public function list_employee() 
    {
        $this->db->order_by('employeeId');
        $this->db->select('employeeId, firstName, lastName, telephone, departmentName');
        $this->db->from('employees');
        $this->db->join('departments', 'employees.departmentId = departments.departmentId', 'left');
        $query = $this->db->get();
        return $query->result();
    }
    public function insert_id() 
    {
        return $this->db->insert_id();
    }
    public function get_employee($id) 
    {
        $query = $this->db->get_where($this->_table, array('employeeId' => $id));
        return $query->row();
    }
    public function add_employee($employee) 
    {
        $data = array(
            'firstName' => $employee['firstName'],
            'lastName' => $employee['lastName'],
            'telephone' => $employee['telephone'],
            'departmentId' => $employee['departmentId']
        );
        $this->db->insert($this->_table, $data);
    }
    public function edit_employee($employee) 
    {
        $data = array(
            'firstName' => $employee['firstName'],
            'lastName' => $employee['lastName'],
            'telephone' => $employee['telephone'],
            'departmentId' => $employee['departmentId']
        );
        $this->db->where('employeeId', $employee['id']);
        $this->db->update($this->_table, $data);
    }
    public function del_employee($id) 
    {
        $this->db->where('employeeId', $id);
        $this->db->delete($this->_table);
    }
}
