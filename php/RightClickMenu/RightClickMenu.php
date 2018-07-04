<?php

namespace php\RightClickMenu;

interface RightClickMenu
{
    public function setItemName($item_name);
    public function setShowName($show_name);
    public function setPath($path);
    public function setIcon($icon);

    public function getItemName();
    public function getShowName();
    public function getPath();
    public function getIcon();
}
