<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdepartment extends CI_Model {

    protected $_table = 'departments';
    public function list_department() 
    {
        $query = $this->db->get($this->_table);
        return $query->result();
    }
    public function insert_id() 
    {
        return $this->db->insert_id();
    }
    public function get_department($id) 
    {
        $query = $this->db->get_where($this->_table, array('departmentId' => $id));
        return $query->row();
    }
    public function add_department($department) 
    {
        $data = array(
            'departmentName' => $department['name']
        );
        $this->db->insert($this->_table, $data);
    }
    public function edit_department($department) 
    {
        $data = array(
            'departmentName' => $department['name'],
        );
        $this->db->where('departmentId', $department['id']);
        $this->db->update($this->_table, $data);
    }
    public function del_department($id) 
    {
        // Transactions start
        $this->db->trans_start();
        // Delete department by id
        $this->db->where('departmentId', $id);
        $this->db->delete($this->_table);
        // Update (departmentId -> 0) for employees who departmentId = this id
        $this->db->set('departmentId', 0);
        $this->db->where('departmentId', $id);
        $this->db->update('employees');
        // Transactions complete
        $this->db->trans_complete();
    }
}
