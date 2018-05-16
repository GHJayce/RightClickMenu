<?php

namespace php\RightClickMenu;

abstract class RCMWindows implements RightClickMenu
{
    public static $version = 'Windows Registry Editor Version 5.00';
    protected $item_name;
    protected $show_name;
    protected $path;
    protected $icon = null;
    protected $target;

    abstract public function create();
    abstract public function remove();

    public function setItemName(string $item_name)
    {
        $this->item_name = $item_name;

        return $this;
    }

    public function setShowName(string $show_name)
    {
        $this->show_name = $show_name;

        return $this;
    }

    public function setPath(string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function setIcon(string $icon)
    {
        $this->icon = empty($this->icon) && empty($icon) ? $this->path : $icon;

        return $this;
    }

    protected function getIcon()
    {
        return empty($this->icon) ? $this->path : $this->icon;
    }

    protected function getPosition()
    {
        return "HKEY_CLASSES_ROOT\\$this->target\\shell\\$this->item_name";
    }

    protected function create_template()
    {
        $position = $this->getPosition();
        $icon = str_replace('\\', '\\\\', $this->getIcon());
        $path = str_replace('\\', '\\\\', $this->path);

        $str = <<<EOS

[$position]
@ = "$this->show_name"
;;Extended
"Icon" = "$icon,0"

[$position\command]
@ = "$path %1"

EOS;

        return isset($this->extended) ? str_replace(';;Extended', '"Extended" = ""', $str) : str_replace(';;Extended', '', $str);
    }

    protected function remove_template()
    {
        return <<<EOS
[-$this->getPosition()]
EOS;
    }
}
