<?php

namespace php\RightClickMenu;

abstract class RCMFactoryMethod
{
    protected $instantiate;

    abstract protected function generate(string $target);

    public function __construct($target)
    {
        $this->instantiate = $this->generate($target);
    }

    public function setItemName(string $item_name)
    {
        return $this->instantiate->setItemName($item_name);
    }

    public function setShowName(string $show_name)
    {
        return $this->instantiate->setItemName($show_name);
    }

    public function setPath(string $path)
    {
        return $this->instantiate->setItemName($path);
    }

    public function setIcon(string $icon)
    {
        return $this->instantiate->setItemName($icon);
    }

    public function create()
    {
        return $this->instantiate->create();
    }

    public function remove()
    {
        return $this->instantiate->remove();
    }
}
