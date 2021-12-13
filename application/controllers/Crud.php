<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Mcrud");
    }
	public function index()
	{
		$this->load->view('crud');
	}
    public function list_emp()
	{
        echo json_encode($this->Mcrud->list_emp());
	}
    public function add_emp()
    {
        $emp = array(
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'tel' => $this->input->post('tel')
        );
        echo json_encode($this->Mcrud->add_emp($emp));
    }
    public function edit_emp()
    {
        $emp = array(
            'id' => $this->input->post('id'),
            'fname' => $this->input->post('fname'),
            'lname' => $this->input->post('lname'),
            'tel' => $this->input->post('tel')
        );
        echo json_encode($this->Mcrud->edit_emp($emp));
    }
    public function del_emp()
	{
        $id = $this->input->post('id');
        echo json_encode($this->Mcrud->del_emp($id));
	}
}
