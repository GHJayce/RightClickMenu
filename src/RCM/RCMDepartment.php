<?php

namespace src\RCM;

use src\Registry\Department;

class RCMDepartment
{
    /**
     * @var AttributeService
     */
    protected $attribute_set;
    /**
     * @var Department
     */
    protected $department;

    public function __construct(AttributeSet $attribute_set, Department $department)
    {
        $this->setAttributeSet($attribute_set);
        $this->setDepartment($department);
    }

    public function setAttributeSet(AttributeSet $attribute_set)
    {
        $this->attribute_set = $attribute_set;

        return $this;
    }

    public function setDepartment(Department $department)
    {
        $this->department = $department;

        return $this;
    }

    public function getAttributeSet()
    {
        return $this->attribute_set;
    }

    public function getDepartment()
    {
        $this->department->setStaff($this->attribute_set->getRegistryName());

        return $this->department;
    }
}