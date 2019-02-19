<?php

namespace RightClickMenu;

class CreateRegistryItem extends GeneratorService
{
    public function generate()
    {
        return $this->department->create();
    }
}