<?php

namespace RightClickMenu;

class Registry implements Generator
{
    protected $generator;
    protected $version = 'Windows Registry Editor Version 5.00';
    protected $items = [];

    public function __construct(GeneratorService $generator)
    {
        $this->generator = $generator;
    }

    public function addItem(RegistryItem $item)
    {
        $this->items[] = $item;
    }

    public function generate()
    {
        $registry = "{$this->version}\n\n";

        foreach ($this->items as $v) {
            $registry .= "{$this->generator->setDepartment($v)->generate()}\n\n";
        }

        return $registry;
    }
}