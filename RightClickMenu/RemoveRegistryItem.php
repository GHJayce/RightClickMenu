<?php

namespace RightClickMenu;

class RemoveRegistryItem extends GeneratorService
{
    public function generate()
    {
        $department = $this->department;

        return $department->remove();
    }
}