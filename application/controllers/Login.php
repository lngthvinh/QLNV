<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index()
    {
        $this->signin();
    }
	public function signin()
    {
        $this->load->view('signin_view');
    }
    public function signup()
    {
        $this->load->view('signup_view');
    }
    public function data()
    {
        if ($this->session->userdata('logged_in'))
        {
            $this->load->view('data');  
        } else {
            redirect('Login/signin');
        }
    }
    public function signin_action()
    {
        if($this->input->post('submit')) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
	
			$query = $this->db->query("SELECT * from users where username='".$username."' and password='".$password."'");
			$row = $query->num_rows();
			if($row) {
			    $data = array(
                    'username' => $this->input->post('username'),
                    'logged_in' => 1
                    );
                $this->session->set_userdata($data);
                redirect('Login/data');
			} else {

		        $data['error']="<p style='color:red'>Something went wrong.</p>";
                $this->load->view('signin_view', $data);
            }
		}
    }
    public function signup_action()
    {
        if($this->input->post('submit')) {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $cpassword = $this->input->post('cpassword');
            
            if ($cpassword == $password) {

                $query = $this->db->query("SELECT username from users where username='".$username."'");
                $row = $query->num_rows();
                if($row) {
                
                    $data['error']="<p style='color:red'>Something went wrong.</p>";
                    $this->load->view('signup_view', $data);
                } else {
                    $query = $this->db->query("INSERT INTO users (username, password) VALUES ('".$username."', '".$password."')");
                    $data = array(
                        'username' => $this->input->post('username'),
                        'logged_in' => 1
                        );
                    $this->session->set_userdata($data);
                    redirect('Login/data');
                }
            } else {
                
		        $data['error']="<p style='color:red'>Something went wrong.</p>";
                $this->load->view('signup_view', $data);
            }
		}
    }
    public function signout()
    {
        $this->session->sess_destroy();
        redirect("Login");
    }
}
