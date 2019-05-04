<?php

namespace src\Registry\Department;

class DesktopBackgroundShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('DesktopBackground\Shell');
    }
}