<?php

require 'common/funs.php';

spl_autoload_register('autoload');

function autoload($class)
{
    require dirname(strtr(__DIR__, '\\', '/')).'/'.strtr($class, '\\', '/') . '.php';
}
