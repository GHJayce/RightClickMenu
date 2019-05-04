<?php

namespace src\Registry\Department;

class FolderShell extends HkeyClassesRoot
{
    public function __construct()
    {
        parent::__construct();
        $this->setChildDepartment('Folder\shell');
    }
}