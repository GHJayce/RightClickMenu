<?php

namespace src\Registry\Department;

use src\Registry\Department;

class HkeyClassesRoot extends Department
{
    public function __construct()
    {
        $this->setParentDepartment('HKEY_CLASSES_ROOT');
    }
}