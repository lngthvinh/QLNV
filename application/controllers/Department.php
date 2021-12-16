<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Mdepartment");
    }
	public function index()
	{
		$this->load->view('department');
	}
    public function list_department()
	{
        echo json_encode($this->Mdepartment->list_department());
	}
    public function add_department()
    {
        $department = array(
            'name' => $this->input->post('name')
        );
        $this->Mdepartment->add_department($department);
        $insert_id = $this->Mdepartment->insert_id();
        echo json_encode($this->Mdepartment->get_department($insert_id));
    }
    public function edit_department()
    {
        $department = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name')
        );
        $this->Mdepartment->edit_department($department);
        echo json_encode($this->Mdepartment->get_department($department['id']));
    }
    public function del_department()
	{
        $id = $this->input->post('id');
        $this->Mdepartment->del_department($id);
        echo json_encode($this->Mdepartment->get_department($id));
	}
}
