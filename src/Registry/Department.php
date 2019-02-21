<?php

namespace src\Registry;

use src\Generator;

abstract class Department implements DepartmentInterface, Generator
{
    protected $parent_department;
    protected $child_department;
    protected $staff;
    protected $staff_item;

    public function generate()
    {
        $list = [
            $this->getParentDepartment(),
            $this->getChildDepartment(),
            $this->getStaff(),
            $this->getStaffItem(),
        ];

        return implode('\\', array_filter($list, function ($v) {
            return !empty($v);
        }));
    }


    public function getParentDepartment()
    {
        return $this->parent_department;
    }

    public function getChildDepartment()
    {
        return $this->child_department;
    }

    public function getStaff()
    {
        return $this->staff;
    }

    public function getStaffItem()
    {
        return $this->staff_item;
    }


    public function setParentDepartment($name)
    {
        $this->parent_department = $name;

        return $this;
    }

    public function setChildDepartment($name)
    {
        $this->child_department = $name;

        return $this;
    }

    public function setStaff($name)
    {
        $this->staff = $name;

        return $this;
    }

    public function setStaffItem($name)
    {
        $this->staff_item = $name;

        return $this;
    }
}