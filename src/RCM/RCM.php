<?php

namespace src\RCM;

use src\Generator;
use src\Registry;
use src\Registry\RegistryItem;

abstract class RCM implements Generator
{
    protected $registry;
    protected $registry_item;
    protected $rcm_department;

//    public function __construct(Registry $registry, RegistryItem $registry_item, RCMDepartment $rcm_department)
//    {
//        $this->registry = $registry;
//        $this->registry_item = $registry_item;
//        $this->rcm_department = $rcm_department;
//    }

    abstract function generate();
}