<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->Model("Mlogin");
    }
    public function index()
    {
        $this->load->view('login');
    }
    public function register()
    {
        $this->load->view('register');
    }
    public function data()
    {
        if ($this->session->userdata('admin_logged_in')) {
            $data['user'] = $this->session->userdata('admin_logged_in');
            $this->load->view('data', $data);  
        } else if ($this->session->userdata('logged_in')) {
            $data['user'] = $this->session->userdata('logged_in');
            $this->load->view('data', $data);  
        } else {
            redirect('Login');
        }
    }
    public function login_action()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');

        $error = "<p style='color:red'>Something went wrong.</p>";
        if ($this->form_validation->run()) {

            $user = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );
            $checkuser = $this->Mlogin->check_user($user);
            if ($checkuser) {

                if ($user['username'] == 'admin') {
                    $this->session->set_userdata('admin_logged_in', $this->input->post('username'));
                    redirect('Crud');
                } else {
                    $this->session->set_userdata('logged_in', $this->input->post('username'));
                    redirect('Login/data');
                }
            } else {

                $user['error'] = $error;
                $this->load->view('login', $user);
            }
        } else {

            $user['error'] = $error;
            $this->load->view('login', $user);
        }
    }
    public function register_action()
    {
        $this->load->helper('security');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|xss_clean');

        $error = "<p style='color:red'>Something went wrong.</p>";
        if ($this->form_validation->run()) {

            $user = array(
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );
            $checkuser = $this->Mlogin->check_user($user);
            $cpassword = md5($this->input->post('cpassword'));
            if ($user['password'] == $cpassword && !$checkuser) {

                $this->Mlogin->add_user($user);
                $this->session->set_userdata('logged_in', $this->input->post('username'));
                redirect('Login/data');
            } else {

                $user['error'] = $error;
                $this->load->view('register', $user);
            }
        } else {

            $user['error'] = $error;
            $this->load->view('register', $user);
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect("Login");
    }
}
