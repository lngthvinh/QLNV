<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="departments")
 */
class DepartmentEntity
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
    var $departmentName;

    public function getId()
    {
        return $this->id;
    }

    public function getDepartmentName()
    {
        return $this->departmentName;
    }

    public function setDepartmentName($departmentName)
    {
        $this->departmentName = $departmentName;
    }
}