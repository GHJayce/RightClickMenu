<?php

namespace RightClickMenu;

abstract class RegistryItem implements RegistryItemInterface, Generator
{
    protected $location;
    protected $attributes = [];

    public function setLocation($location)
    {
        $this->location = $location;
    }

    abstract function getLocation();
    abstract function create();
    abstract function remove();
    abstract function generate();
}