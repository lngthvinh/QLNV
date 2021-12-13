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
        echo json_encode($this->Memployee->add_employee($employee));
    }
    public function edit_employee()
    {
        $employee = array(
            'id' => $this->input->post('id'),
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'telephone' => $this->input->post('telephone')
        );
        echo json_encode($this->Memployee->edit_employee($employee));
    }
    public function del_employee()
	{
        $id = $this->input->post('id');
        echo json_encode($this->Memployee->del_employee($id));
	}
}
