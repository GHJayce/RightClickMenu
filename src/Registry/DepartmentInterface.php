<?php

namespace src\Registry;

interface DepartmentInterface
{
    public function setParentDepartment($name);
    public function setChildDepartment($name);
    public function setStaff($name);
    public function setStaffItem($name);

    public function getParentDepartment();
    public function getChildDepartment();
    public function getStaff();
    public function getStaffItem();
}