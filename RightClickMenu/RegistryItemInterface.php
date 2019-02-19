<?php

namespace RightClickMenu;

interface RegistryItemInterface
{
    public function setLocation($location);
    public function getLocation();
    public function create();
    public function remove();
}