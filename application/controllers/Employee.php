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
        if ($this->session->userdata('admin_logged_in')) {
            $data['result'] = $this->Memployee->list_emp();
            $this->load->view('employee/list_emp', $data);
        } else {
            redirect('Login');
        }
	}
    public function add_emp()
    {
        $this->load->view('employee/add_emp');
    }
    public function add_action()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'First name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('lname', 'Last name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('job', 'Job', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {

            $emp = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'job' => $this->input->post('job')
            );
            $this->Memployee->add_emp($emp);
            redirect('Employee');
        } else {

            $emp['error'] = "<p style='color:red'>Something went wrong.</p>";
            $this->load->view('add_emp', $emp);
        }
    }
	public function get_emp($id = 0)
	{
        $data['row'] = $this->Memployee->get_emp($id);
		$this->load->view('employee/get_emp', $data);
	}
    public function edit_emp($id = 0)
    {
        $data['row'] = $this->Memployee->get_emp($id);
        $this->load->view('employee/edit_emp', $data);
    }
    public function edit_action($id = 0)
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('fname', 'First name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('lname', 'Last name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('job', 'Job', 'required|trim|xss_clean');

        if ($this->form_validation->run()) {

            $emp = array(
                'fname' => $this->input->post('fname'),
                'lname' => $this->input->post('lname'),
                'job' => $this->input->post('job')
            );
            $this->Memployee->edit_emp($id, $emp);
            redirect('Employee');
        } else {

            $emp['error'] = "<p style='color:red'>Something went wrong.</p>";
            $this->load->view('edit_emp', $emp);
        }
    }
    public function del_emp($id = 0)
	{
        $data['id'] = $id;
        $this->load->view('employee/del_emp', $data);
	}
    public function del_action($id = 0)
	{
        $this->Memployee->del_emp($id);
		redirect('Employee');
	}
}
