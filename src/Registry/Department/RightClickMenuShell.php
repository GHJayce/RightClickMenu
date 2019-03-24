<?php

namespace src\Registry\Department;

class RightClickMenuShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('RightClickMenu\shell');
    }
}