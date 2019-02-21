<?php

namespace src\RCM;

use src\Registry\Department;
use src\Registry\Department\AllShell;
use src\Registry\Department\DirectoryShell;
use src\Registry\Registry;
use src\Registry\RegistryItemService;

class RightClickMenu extends RCM
{
    private $params;
    protected $registry;
    protected $registry_item;
    protected $rcm_department;
    protected $attribute_set;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->registry = new Registry();
        $this->registry_item = new RegistryItemService();
        $this->attribute_set = new AttributeService();
        $this->rcm_department = new RCMDepartment();
    }

    public function generate()
    {
        $registry = $this->registry;
        $attribute_set = $this->attribute_set;
        $rcm_department = $this->rcm_department;

        foreach ($this->params as $v) {
            $attribute_set
                ->setRegistryName($v['registry_name'])
                ->setMenuName($v['menu_name'])
                ->setPath($v['path']);

            if (!empty($v['icon'])) {
                $attribute_set->setIcon($v['icon']);
            }

            foreach ($v['department'] as $dk => $dv) {
                $department = $this->getDepartmentByFlag($dv);
                $rcm_department
                    ->setAttributeSet($attribute_set)
                    ->setDepartment($department);

                // 创建员工
                $registry_item = $this->cloneRegistryItem();
                $registry_item
                    ->setLocation(
                        $rcm_department
                            ->getDepartment()
                            ->generate()
                    )
                    ->setAttribute('@', $attribute_set->getMenuName())
                    ->setAttribute('Icon', $attribute_set->getIcon());
                if (!empty($v['extend'][$dk])) {
                    $registry_item->setAttribute('Extended', $attribute_set->getExtend());
                }
                $registry->addRegistryItem($registry_item);

                // 分配设备
                $registry_item = $this->cloneRegistryItem();
                $registry_item
                    ->setLocation(
                        $rcm_department
                            ->getDepartment()
                            ->setStaffItem('Command')
                            ->generate()
                    )
                    ->setAttribute('@', $attribute_set->getPath());
                $registry->addRegistryItem($registry_item);
            }
        }

        var_dump($registry->generate());
    }

    private function cloneRegistryItem()
    {
        $this->registry_item = clone $this->registry_item;

        return $this->registry_item;
    }

    private function getDepartmentByFlag($flag)
    {
        $department = '';

        if ($flag == 1) {
            $department = new DirectoryShell();
        } elseif ($flag == 2) {
            $department = new AllShell();
        } elseif ($flag == 3) {
            $department = new Department\DirectoryBackgroundShell();
        }

        return $department;
    }
}