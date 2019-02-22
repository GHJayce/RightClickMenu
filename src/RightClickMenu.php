<?php

namespace src;

use src\RCM\AttributeService;
use src\RCM\AttributeSet;
use src\RCM\CreatorService;
use src\RCM\RCMDepartment;
use src\RCM\RemoverService;
use src\Registry\Department;
use src\Registry\Registry;
use src\Registry\RegistryItemService;

class RightClickMenu implements Generator
{
    private $params;
    private $creator_registry_content = '';
    private $remover_registry_content = '';
    private $creator_registry;
    private $remover_registry;
    private $creator_registry_item;
    private $remover_registry_item;
    private $attribute_set;
    /**
     * @var RCMDepartment
     */
    private $rcm_department;

    public function __construct(array $params)
    {
        $this->params = $params;

        $this->creator_registry = new Registry();
        $this->remover_registry = clone $this->creator_registry;
        $this->creator_registry_item = new RegistryItemService();
        $this->remover_registry_item = clone $this->creator_registry_item;
        $this->attribute_set = new AttributeService();
    }

    public function generate()
    {
        $attribute_set = $this->attribute_set;

        $creator_service = new CreatorService($this->creator_registry, $this->creator_registry_item);
        $remover_service = new RemoverService($this->remover_registry, $this->remover_registry_item);

        foreach ($this->params as $v) {
            $attribute_set
                ->setRegistryName($v['registry_name'])
                ->setMenuName($v['menu_name'])
                ->setPath($v['path']);

            if (!empty($v['icon'])) {
                $attribute_set->setIcon($v['icon']);
            } else {
                $attribute_set->setIcon($v['path']);
            }

            foreach ($v['department'] as $dk => $dv) {

                if (isset($v['extend'][$dk]) && $v['extend'][$dk] == 1) {
                    $attribute_set->setExtend('');
                } else {
                    $attribute_set->setExtend(false);
                }

                $department = $this->getDepartmentByFlag($dv);

                $rcm_department = $this->getRCMDepartment($attribute_set, $department);

                $creator_service->setRCMDepartment($rcm_department)->handle();
                $remover_service->setRCMDepartment($rcm_department)->handle();
            }
        }

        return [
            'create' => $this->creator_registry_content = $creator_service->generate(),
            'remove' => $this->remover_registry_content = $remover_service->generate(),
        ];
    }

    private function getRCMDepartment(AttributeSet $attribute_set, Department $department)
    {
        if (empty($this->rcm_department)) {
            return new RCMDepartment($attribute_set, $department);
        } else {
            return $this->rcm_department
                ->setAttributeSet($attribute_set)
                ->setDepartment($department);
        }
    }

    private function getDepartmentByFlag($flag)
    {
        $department = '';

        if ($flag == 1) {
            $department = new Department\DirectoryShell();
        } elseif ($flag == 2) {
            $department = new Department\AllShell();
        } elseif ($flag == 3) {
            $department = new Department\DirectoryBackgroundShell();
        }

        return $department;
    }
}