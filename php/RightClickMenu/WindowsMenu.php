<?php

namespace php\RightClickMenu;

abstract class WindowsMenu extends RightMenu
{
    protected $version = 'Windows Registry Editor Version 5.00';
    protected $register_item;
    protected $extended;

    public function __construct($item, $name, $path, $icon, $extended = null)
    {
        parent::__construct($item, $name, $path, $icon);

        $this->extended = $extended;
    }

    protected function template($target)
    {
        $position = "HKEY_CLASSES_ROOT\\$target\shell\\$this->item";
        $icon = str_replace('\\', '\\\\', $this->icon);
        $path = str_replace('\\', '\\\\', $this->path);
        
        $str = <<<EOS
    
[$position]
@ = "$this->name"
;;Extended
"Icon" = "$icon,0"

[$position\command]
@ = "$path %1"
    
EOS;

        return isset($this->extended) ? str_replace(';;Extended', '"Extended" = ""', $str) : str_replace(';;Extended', '', $str);
    }

    abstract public function generate();
}
