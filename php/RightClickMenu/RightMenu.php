<?php

namespace php\RightClickMenu;

abstract class RightMenu
{
    protected $item;
    protected $name;
    protected $path;
    protected $icon;

    public function __construct($item, $name, $path, $icon)
    {
        $this->item = $item;
        $this->name = $name;
        $this->path = $path;
        $this->icon = $icon;
    }
}
