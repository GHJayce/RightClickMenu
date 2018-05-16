<?php

namespace php\RightClickMenu;

class RCMWindowsSelectedDirectory extends RCMWindows
{
    protected $target = 'Directory';

    public function create()
    {
        return $this->create_template();
    }

    public function remove()
    {
        return $this->remove_template();
    }
}