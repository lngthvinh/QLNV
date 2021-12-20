<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class EmployeeEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    var $id;
    /**
     * @ORM\Column(type="string")
     */
    var $firstName;
    /**
     * @ORM\Column(type="string")
     */
    var $lastName;
    /**
     * @ORM\Column(type="string")
     */
    var $telephone;
    /**
     * @ORM\Column(type="integer")
     */
    var $departmentId;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    public function setDepartmentId($departmentId)
    {
        $this->departmentId = $departmentId;
    }
}