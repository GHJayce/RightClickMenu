<?php

namespace RightClickMenu;

abstract class RightClickMenu extends HkeyClassesRoot
{
    protected $registry_name;
    protected $menu_name;
    protected $path;
    protected $icon;
    protected $extend;

    public function getPath()
    {
        $this->generate();
    }
}