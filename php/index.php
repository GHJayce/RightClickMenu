<?php

require 'autoload.php';

use php\RightClickMenu\WindowsBackgroundMenu;

$WindowsBackgroundMenu = new WindowsBackgroundMenu('notepad++', '使用notepad++打开', 'E:\installed\Notepad++\notepad++.exe', 'E:\installed\Notepad++\notepad++.exe', '');
dump($WindowsBackgroundMenu->generate());