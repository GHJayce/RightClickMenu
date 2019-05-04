<?php

namespace src\RCM;

class CreatorService extends Service
{
    public function handle()
    {
        $list = [
            self::IMPLEMENT_FLAG_SINGLE => 'singleHandle',
            self::IMPLEMENT_FLAG_CASCADE => 'cascadeHandle',
        ];

        $this->implement_flag = empty($this->implement_flag) ? self::IMPLEMENT_FLAG_SINGLE : $this->implement_flag;

        $this->commonHandle();
        $this->{$list[$this->implement_flag]}();
    }

    /**
     * 抽出共同的处理
     */
    protected function commonHandle()
    {
        $this->cloneRegistryItem();
        $this->registerStaffForDepartment();
        $this->createStaffArchive();
        $this->addRegistryItem();
    }

    /**
     * 单菜单实现处理
     */
    protected function singleHandle()
    {
        $this->cloneRegistryItem();
        $this->registerDeviceByStaff();
        $this->allocationDeviceForStaff();
        $this->addRegistryItem();
    }

    /**
     * 级联菜单实现处理
     */
    protected function cascadeHandle()
    {
        $this->registry_item->setAttribute('ExtendedSubCommandsKey', $this->attribute_set->getExtendedSubCommandsKey());
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