<?php

namespace src\Registry;

use src\Generator;

class Registry implements Generator
{
    protected $version = 'Windows Registry Editor Version 5.00';
    protected $items = [];

    public function __construct()
    {

    }

    public function addRegistryItem(RegistryItem $achieve)
    {
        $this->items[] = $achieve;
    }

    public function generate()
    {
        $registry = "{$this->version}\n\n";

        foreach ($this->items as $v) {
            $registry .= "{$v->generate()}\n\n";
        }

        return $registry;
    }

    public function __clone()
    {
        $this->items = [];
    }
}