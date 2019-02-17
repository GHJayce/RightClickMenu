<?php

namespace RightClickMenu;

class RemoveRegistryItem extends RegistryItem
{
    public function generate()
    {
        return "[-{$this->item_name}\{$this->item_path}]";
    }
}