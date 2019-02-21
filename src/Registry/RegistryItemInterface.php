<?php

namespace src\Registry;

interface RegistryItemInterface
{
    public function create();
    public function remove();

    public function setOperate($operate);

    public function setLocation($location);
    public function setAttribute($key, $val);

    public function getLocation();
    public function getAttributes();
}