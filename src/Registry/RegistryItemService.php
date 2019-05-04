<?php

namespace src\Registry;

class RegistryItemService extends RegistryItem
{
    protected $attributes = [];

    public function setAttribute($key, $val)
    {
        $this->attributes[$key] = $val;

        return $this;
    }

    public function setLocation($location = '')
    {
        $this->location = $location;

        return $this;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function generate()
    {
        $registry_item = '';

        switch ($this->operate) {
            case 'create':
                $registry_item = $this->create();
                break;
            case 'remove':
                $registry_item = $this->remove();
        }

        return $registry_item;
    }

    public function create()
    {
        $attributes = $this->getAttributes();
        $item = "[{$this->getLocation()}]";

        foreach ($attributes as $k => $v) {
            $key = $k === '@' ? '@' : "\"$k\"";
            $item .= "\n{$key} = \"".addcslashes($v, '"\\')."\"";
        }

        return "{$item}\n";
    }

    public function remove()
    {
        return "[-{$this->getLocation()}]";
    }

    public function __clone()
    {
        $this->attributes = [];
    }
}