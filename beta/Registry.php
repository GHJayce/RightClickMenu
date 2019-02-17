<?php

namespace RightClickMenu;

class Registry implements Generator
{
    protected $version = 'Windows Registry Editor Version 5.00';
    protected $items = [];

    public function __construct(RegistryItem $item)
    {
        $this->addItem($item);
    }

    public function addItem(RegistryItem $item)
    {
        $this->items[] = $item;
    }

    public function generate()
    {
        $registry = "{$this->version}\n\n";

        foreach ($this->items as $v) {
            $registry .= "{$v->generate()}\n\n";
        }

        return $registry;
    }
}