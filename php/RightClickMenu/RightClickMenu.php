<?php

namespace php\RightClickMenu;

interface RightClickMenu
{
    // protected $item;
    // protected $name;
    // protected $path;
    // protected $icon;

    public function setItemName(string $item_name);
    public function setShowName(string $show_name);
    public function setPath(string $path);
    public function setIcon(string $icon);

    // public function __construct($item, $name, $path, $icon)
    // {
    //     $this->item = $item;
    //     $this->name = $name;
    //     $this->path = $path;
    //     $this->icon = $icon;
    // }
}
