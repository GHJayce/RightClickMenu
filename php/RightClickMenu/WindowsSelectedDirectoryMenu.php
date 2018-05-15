<?php

namespace php\RightClickMenu;

class WindowsBackgroundMenu extends windowsMenu
{
    public function generate()
    {
        return $this->template('Directory');
    }
}
