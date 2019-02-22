<?php

namespace src\RCM;

use src\Generator;
use src\Registry\Registry;
use src\Registry\RegistryItemService;

abstract class Service implements Generator
{
    protected $registry_content = '';
    protected $registry;
    protected $registry_item;
    /**
     * @var RCMDepartment
     */
    protected $rcm_department;
    /**
     * @var AttributeSet
     */
    protected $attribute_set;

    abstract function handle();

    public function __construct(Registry $registry, RegistryItemService $registry_item)
    {
        $this->registry = $registry;
        $this->registry_item = $registry_item;
    }

    public function generate()
    {
        return $this->registry->generate();
    }

    public function setRCMDepartment(RCMDepartment $rcm_department)
    {
        $this->rcm_department = $rcm_department;
        $this->attribute_set = $rcm_department->getAttributeSet();

        return $this;
    }

    protected function cloneRegistryItem()
    {
        $this->registry_item = clone $this->registry_item;
    }

    protected function addRegistryItem()
    {
        $this->registry->addRegistryItem($this->registry_item);
    }

    /**
     * 注册员工到指定部门
     */
    protected function registerStaffForDepartment()
    {
        $this->registry_item->setLocation($this->rcm_department->getDepartment()->setStaffItem('')->generate());
    }
}