<?php

namespace src\RCM;

class CreatorService extends Service
{
    public function handle()
    {
        $this->cloneRegistryItem();
        $this->registerStaffForDepartment();
        $this->createStaffArchive();
        $this->addRegistryItem();

        $this->cloneRegistryItem();
        $this->registerDeviceByStaff();
        $this->allocationDeviceForStaff();
        $this->addRegistryItem();
    }

    /**
     * 注册设备到指定部门 跟员工所属部门走
     */
    private function registerDeviceByStaff()
    {
        $this->registry_item->setLocation($this->rcm_department->getDepartment()->setStaffItem('Command')->generate());
    }

    /**
     * 分配设备给员工
     */
    private function allocationDeviceForStaff()
    {
        $this->registry_item->setAttribute('@', $this->attribute_set->getPath());
    }

    /**
     * 创建员工档案
     */
    private function createStaffArchive()
    {
        $attribute_set = $this->attribute_set;
        $this->registry_item
            ->setAttribute('@', $attribute_set->getMenuName())
            ->setAttribute('Icon', $attribute_set->getIcon());

        if (($extended = $attribute_set->getExtend()) !== false) {
            $this->registry_item->setAttribute('Extended', $extended);
        }
    }
}