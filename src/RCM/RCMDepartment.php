<?php

namespace src\RCM;

use src\Registry\Department;

class RCMDepartment
{
    /**
     * @var AttributeService
     */
    protected $attribute_service;
    /**
     * @var Department
     */
    protected $department;

    public function __construct()
    {

    }

    public function setAttributeSet(AttributeSet $attribute_service)
    {
        $this->attribute_service = $attribute_service;

        return $this;
    }

    public function setDepartment(Department $department)
    {
        $this->department = $department;

        return $this;
    }

    public function getDepartment()
    {
        $this->department->setStaff($this->attribute_service->getRegistryName());

        return $this->department;
    }
}