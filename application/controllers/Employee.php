<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->load->Model("Memployee");
    }
	public function index()
	{
		$this->load->view('employee');
	}
    public function list_employees()
	{
        // echo json_encode($this->Memployee->list_employee());

        ### Doctrine
        require_once "application/bootstrap.php";
        $query = $entityManager->createQuery("
            SELECT e.id, e.firstName, e.lastName, e.telephone, d.departmentName 
            FROM EmployeeEntity e
            LEFT JOIN DepartmentEntity d WITH e.departmentId = d.id
        ");
        $results = $query->getResult();
        echo json_encode($results);
	}
    public function add_employee()
    {
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'telephone' => $this->input->post('telephone'),
            'departmentId' => $this->input->post('departmentId')
        );
        // $this->Memployee->add_employee($data);
        // $insert_id = $this->Memployee->insert_id();
        // echo json_encode($this->Memployee->get_employee($insert_id));

        ### Doctrine
        require_once "application/bootstrap.php";
        $employee = new EmployeeEntity();
        $employee->setFirstName($data['firstName']);
        $employee->setLastName($data['lastName']);
        $employee->setTelephone($data['telephone']);
        $employee->setDepartmentId($data['departmentId']);
        $entityManager->persist($employee);
        $entityManager->flush();
        $insert_id = $employee->getId();
        $insert_employee = $entityManager->find('EmployeeEntity', $insert_id);
        $results = json_decode(json_encode($insert_employee), true);
        echo json_encode($results);
    }
    public function edit_employee()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'telephone' => $this->input->post('telephone'),
            'departmentId' => $this->input->post('departmentId')
        );
        // $this->Memployee->edit_employee($data);
        // echo json_encode($this->Memployee->get_employee($data['id']));

        ### Doctrine
        require_once "application/bootstrap.php";
        $employee = $entityManager->find('EmployeeEntity', $data['id']);
        $employee->setFirstName($data['firstName']);
        $employee->setLastName($data['lastName']);
        $employee->setTelephone($data['telephone']);
        $employee->setDepartmentId($data['departmentId']);
        $entityManager->flush();
        $results = json_decode(json_encode($employee), true);
        echo json_encode($results);
    }
    public function del_employee()
	{
        $id = $this->input->post('id');
        // $this->Memployee->del_employee($id);
        // echo json_encode($this->Memployee->get_employee($id));

        ### Doctrine
        require_once "application/bootstrap.php";
        $employee = $entityManager->find('EmployeeEntity', $id);
        $entityManager->remove($employee);
        $entityManager->flush();
        echo json_encode($employee->getId()); // return null if remove success
	}
}
