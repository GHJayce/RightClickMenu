<?php

namespace src\RCM;

use src\Registry\Registry;
use src\Registry\RegistryItem;
use src\Registry\RegistryItemService;

class RemoverService extends Service
{
    public function handle()
    {
        $this->cloneRegistryItem();
        $this->registry_item->setOperate('remove');
        $this->registerStaffForDepartment();
        $this->addRegistryItem();
    }
}