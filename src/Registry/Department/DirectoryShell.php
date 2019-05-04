<?php

namespace src\Registry\Department;

class DirectoryShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('Directory\shell');
    }
}