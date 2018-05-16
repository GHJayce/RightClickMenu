<?php

namespace php\RightClickMenu;

class RCMWindowsSelectedAllFile extends RCMWindows
{
    protected $target = '*';

    public function create()
    {
        return $this->create_template();
    }

    public function remove()
    {
        return $this->remove_template();
    }
}