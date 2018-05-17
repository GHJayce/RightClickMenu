<?php

namespace php\RightClickMenu;

interface RightClickMenu
{
    public function setItemName(string $item_name);
    public function setShowName(string $show_name);
    public function setPath(string $path);
    public function setIcon(string $icon);

    public function getItemName();
    public function getShowName();
    public function getPath();
    public function getIcon();
}
