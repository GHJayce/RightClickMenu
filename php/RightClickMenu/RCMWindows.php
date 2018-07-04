<?php

namespace php\RightClickMenu;

class RCMWindows implements RightClickMenu
{
    protected $version = 'Windows Registry Editor Version 5.00';
    protected $item_name;
    protected $show_name;
    protected $path;
    protected $icon = null;
    protected $extended = null;

    public function setItemName($item_name)
    {
        $this->item_name = $item_name;

        return $this;
    }

    public function setShowName($show_name)
    {
        $this->show_name = $show_name;

        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function setExtended($extended)
    {
        $this->extended = $extended;

        return $this;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getItemName()
    {
        return addcslashes($this->item_name, '"');
    }

    public function getShowName()
    {
        return addcslashes($this->show_name, '"');
    }

    public function getPath()
    {
        return addcslashes(str_replace('\\', '\\\\', $this->path), '"');
    }

    public function getIcon()
    {
        $icon = empty($this->icon) ? str_replace('\\', '\\\\', $this->path) : str_replace('\\', '\\\\', $this->icon);

        return addcslashes($icon, '"');
    }

    public function getExtended()
    {
        return $this->extended;
    }
}
