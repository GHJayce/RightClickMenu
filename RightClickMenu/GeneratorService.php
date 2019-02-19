<?php

namespace RightClickMenu;

abstract class GeneratorService implements Generator
{
    /**
     * @var RCMDepartment
     */
    protected $department;

    public function setDepartment(RCMDepartment $department)
    {
        $this->department = $department;

        return $this;
    }

    abstract function generate();
}