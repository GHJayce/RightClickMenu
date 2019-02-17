<?php

namespace RightClickMenu;

class CreateRegistryItem extends RegistryItem
{
    public function generate()
    {
        $item = "[{$this->item_name}\{$this->item_path}]";

        foreach ($this->attributes as $k => $v) {
            $key = $k === '@' ? '@' : "\"$k\"";
            $item .= "\n{$key} = \"{$v}\"";
        }

        return "{$item}";
    }
}