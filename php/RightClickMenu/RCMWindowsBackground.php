<?php

namespace php\RightClickMenu;

class RCMWindowsBackground extends RCMWindows
{
    protected $target = 'Directory\\background';

    public function create()
    {
        return $this->create_template();
    }

    public function remove()
    {
        return $this->remove_template();
    }
}