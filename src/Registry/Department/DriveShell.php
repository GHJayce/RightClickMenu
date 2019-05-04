<?php

namespace src\Registry\Department;

class DriveShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('Drive\shell');
    }
}