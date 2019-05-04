<?php

namespace src\RCM;

interface AttributeSet
{
    public function setRegistryName($registry_name);
    public function setMenuName($menu_name);
    public function setPath($path);
    public function setIcon($icon);
    public function setExtend($extend);
    public function setExtendedSubCommandsKey($position);

    public function getRegistryName();
    public function getMenuName();
    public function getPath();
    public function getIcon();
    public function getExtend();
    public function getExtendedSubCommandsKey();
}