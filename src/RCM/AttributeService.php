<?php

namespace src\RCM;

class AttributeService implements AttributeSet
{
    protected $registry_name;
    protected $menu_name;
    protected $path;
    protected $icon;
    protected $extend;

    public function setRegistryName($registry_name)
    {
        $this->registry_name = $registry_name;

        return $this;
    }

    public function setMenuName($menu_name)
    {
        $this->menu_name = $menu_name;

        return $this;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    public function setExtend($extend)
    {
        $this->extend = $extend;

        return $this;
    }

    public function getRegistryName()
    {
        return $this->registry_name;
    }

    public function getMenuName()
    {
        return $this->menu_name;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function getExtend()
    {
        return isset($this->extend) ? $this->extend : false;
    }
}