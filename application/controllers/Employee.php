<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Memployee");
    }
	public function index()
	{
		$this->load->view('employee');
	}
    public function list_employee()
	{
        echo json_encode($this->Memployee->list_employee());
	}
    public function add_employee()
    {
        $employee = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'telephone' => $this->input->post('telephone')
        );
        $this->Memployee->add_employee($employee);
        $insert_id = $this->Memployee->insert_id();
        echo json_encode($this->Memployee->get_employee($insert_id));
    }
    public function edit_employee()
    {
        $employee = array(
            'id' => $this->input->post('id'),
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'telephone' => $this->input->post('telephone')
        );
        $this->Memployee->edit_employee($employee);
        echo json_encode($this->Memployee->get_employee($employee['id']));
    }
    public function del_employee()
	{
        $id = $this->input->post('id');
        $this->Memployee->del_employee($id);
        echo json_encode($this->Memployee->get_employee($id));
	}
}
