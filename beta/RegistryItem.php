<?php

namespace RightClickMenu;

abstract class RegistryItem implements Generator
{
    protected $item_name;
    protected $item_path;
    protected $attributes = [];

    public function addAttr($key, $val)
    {
        $this->attributes[$key] = $val;
    }

    abstract function generate();
}