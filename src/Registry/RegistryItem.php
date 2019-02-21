<?php

namespace src\Registry;


use src\Generator;

abstract class RegistryItem implements RegistryItemInterface, Generator
{
    protected $operate = 'create';
    protected $location;
    protected $attributes;

    public function setOperate($operate)
    {
        $this->operate = $operate;

        return $this;
    }

    abstract function setAttribute($key, $val);

    abstract function setLocation($location);

    abstract function getLocation();

    public function getAttributes()
    {
        return $this->attributes;
    }

    abstract function generate();

    abstract function create();

    abstract function remove();
}