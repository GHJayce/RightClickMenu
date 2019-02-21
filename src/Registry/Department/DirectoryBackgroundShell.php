<?php

namespace src\Registry\Department;

use src\Registry\Department;

class DirectoryBackgroundShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('Directory\Background\Shell');
    }
}