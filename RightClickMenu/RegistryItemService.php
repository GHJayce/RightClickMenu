<?php

namespace RightClickMenu;

abstract class RegistryItemService extends RegistryItem
{
    protected $item_key;
    protected $item_path;
    protected $in_path_name;
    protected $attributes = [];

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getLocation()
    {
        return $this->getItemKey().'\\'.$this->getItemPath().'\\'.$this->getInPathName();
    }

    public function addAttr($key, $val)
    {
        $this->attributes[$key] = $val;
    }

    public function resetAttr()
    {
        $this->attributes = [];

        return $this;
    }

    public function getItemKey()
    {
        return $this->item_key;
    }

    public function getItemPath()
    {
        return $this->item_path;
    }

    public function getInPathName()
    {
        return $this->in_path_name;
    }

    public function setItemKey($item_key)
    {
        $this->item_key = $item_key;

        return $this;
    }

    public function setItemPath($item_path)
    {
        $this->item_path = $item_path;

        return $this;
    }

    public function setInPathName($in_path_name)
    {
        $this->in_path_name = $in_path_name;

        return $this;
    }
}