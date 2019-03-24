<?php

namespace service;

use src\Generator;
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

        $this->handleParams($this->params, $attribute_set, $creator_service, $remover_service);

        return [
            'create' => $this->creator_registry_content = $creator_service->generate(),
            'remove' => $this->remover_registry_content = $remover_service->generate(),
        ];
    }

    private function handleParams(array $params, AttributeService $attribute_set, CreatorService &$creator_service, RemoverService &$remover_service, $department_position = '')
    {
        foreach ($params as $v) {
            $attribute_set
                ->setRegistryName($v['registry_name'])
                ->setMenuName($v['menu_name']);

            if (!empty($v['children'])) {
                $creator_service->setCasCadeImplementer();
                $attribute_set->setIcon($v['icon']);
                if (empty($v['department'])) {
                    $department = $this->getDepartmentByFlag(0);

                    $children_registry_name = $department->getChildDepartment().'\\'.md5($v['registry_name'].$v['menu_name'].'\shell');
                    $department->setChildDepartment($department_position.'\shell');
                    $attribute_set->setExtendedSubCommandsKey($children_registry_name);
                    $this->handleParamsByDepartments($department, $attribute_set, $creator_service, $remover_service);
                } else {
                    foreach ($v['department'] as $dk => $dv) {
                        if (isset($v['extend'][$dk]) && $v['extend'][$dk] == 1) {
                            $attribute_set->setExtend('');
                        } else {
                            $attribute_set->setExtend(false);
                        }
                        $department = $this->getDepartmentByFlag($dv);

                        $rcm_department = $this->getDepartmentByFlag(0);
                        $children_registry_name = $rcm_department->getChildDepartment().'\\'.md5($v['registry_name'].$v['menu_name'].'\shell');
                        $attribute_set->setExtendedSubCommandsKey($children_registry_name);
                        $this->handleParamsByDepartments($department, $attribute_set, $creator_service, $remover_service);
                    }
                }

                $this->handleParams($v['children'], $attribute_set, $creator_service, $remover_service, $children_registry_name);
            } else {
                $creator_service->setSingleImplementer();
                $attribute_set->setPath(strpos($v['path'], '.exe') !== false ? $v['path'] . ' %1' : $v['path']);
                if (!empty($v['icon'])) {
                    $attribute_set->setIcon($v['icon']);
                } else {
                    $attribute_set->setIcon($v['path']);
                }
                if (!empty($v['department'])) {
                    foreach ($v['department'] as $dk => $dv) {
                        if (isset($v['extend'][$dk]) && $v['extend'][$dk] == 1) {
                            $attribute_set->setExtend('');
                        } else {
                            $attribute_set->setExtend(false);
                        }

                        $department = $this->getDepartmentByFlag($dv);

                        $this->handleParamsByDepartments($department, $attribute_set, $creator_service, $remover_service);
                    }
                } else {
                    $department = $this->getDepartmentByFlag(0);
                    $department->setChildDepartment($department_position.'\shell');
                    $this->handleParamsByDepartments($department, $attribute_set, $creator_service, $remover_service);
                }
            }
        }
    }

    private function handleParamsByDepartments(Department $department, AttributeService $attribute_set, CreatorService &$creator_service, RemoverService &$remover_service)
    {
        $rcm_department = $this->getRCMDepartment($attribute_set, $department);

        $creator_service->setRCMDepartment($rcm_department)->handle();
        $remover_service->setRCMDepartment($rcm_department)->handle();
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

    /**
     * @param int|string $flag
     * @return Department
     */
    protected function getDepartmentByFlag($flag)
    {
        $department_list = [
            0 => 'RightClickMenuShell',
            1 => 'DirectoryShell',
            2 => 'AllShell',
            3 => 'DirectoryBackgroundShell',
        ];
        $object = '\src\Registry\Department\\'.$department_list[$flag];

        return new $object;
    }
}