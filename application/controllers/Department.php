<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        // $this->load->Model("Mdepartment");
    }
	public function index()
	{
		$this->load->view('department');
	}
    public function list_departments()
	{
        // echo json_encode($this->Mdepartment->list_department());

        ### Doctrine
        require_once "application/bootstrap.php";
        $departmentRepository = $entityManager->getRepository('DepartmentEntity');
        $departments = $departmentRepository->findAll();
        $results = json_decode(json_encode($departments), true);
        echo json_encode($results);
	}
    public function add_department()
    {
        $data = array(
            'name' => $this->input->post('name')
        );
        // $this->Mdepartment->add_department($data);
        // $insert_id = $this->Mdepartment->insert_id();
        // echo json_encode($this->Mdepartment->get_department($insert_id));

        ### Doctrine
        require_once "application/bootstrap.php";
        $department = new DepartmentEntity();
        $department->setDepartmentName($data['name']);
        $entityManager->persist($department);
        $entityManager->flush();
        $insert_id = $department->getId();
        $insert_department = $entityManager->find('DepartmentEntity', $insert_id);
        $results = json_decode(json_encode($insert_department), true);
        echo json_encode($results);
    }
    public function edit_department()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name')
        );
        // $this->Mdepartment->edit_department($data);
        // echo json_encode($this->Mdepartment->get_department($data['id']));

        ### Doctrine
        require_once "application/bootstrap.php";
        $department = $entityManager->find('DepartmentEntity', $data['id']);
        $department->setDepartmentName($data['name']);
        $entityManager->flush();
        $results = json_decode(json_encode($department), true);
        echo json_encode($results);
    }
    public function del_department()
	{
        $id = $this->input->post('id');
        // $this->Mdepartment->del_department($id);
        // echo json_encode($this->Mdepartment->get_department($id));

        ### Doctrine
        require_once "application/bootstrap.php";
        $entityManager->getConnection()->beginTransaction(); // suspend auto-commit
        try {
            $department = $entityManager->find('DepartmentEntity', $id);
            $entityManager->remove($department);
            $employees = $entityManager->getRepository('EmployeeEntity')->findBy(array('departmentId' => $id));
            foreach ($employees as $employee) {
                $employee->setDepartmentId(0);
            }
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            echo json_encode($department->getId()); // return null if remove success
        } catch (Exception $e) {
            $entityManager->getConnection()->rollBack();
            throw $e;
        }
	}
}
