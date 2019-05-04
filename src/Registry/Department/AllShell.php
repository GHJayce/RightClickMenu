<?php

namespace src\Registry\Department;

class AllShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('*\shell');
    }
}