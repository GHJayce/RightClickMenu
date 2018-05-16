<?php

require 'autoload.php';

use php\RightClickMenu\RCMWindowsFactory;

$windows_right_click_menu = new RCMWindowsFactory('background');

$text = $windows_right_click_menu->getVersion();

$text .= $windows_right_click_menu->setItemName('notepad++')
                                 ->setShowName('使用notepad++打开')
                                 ->setPath('E:\installed\Notepad++\notepad++.exe')
                                 ->setIcon('E:\installed\Notepad++\1.ico')
                                 ->create();

$windows_right_click_menu = new RCMWindowsFactory('selectedDirectory');
$text .= $windows_right_click_menu->setItemName('notepad++')
                                 ->setShowName('使用notepad++打开')
                                 ->setPath('E:\installed\Notepad++\notepad++.exe')
                                 ->create();

$windows_right_click_menu = new RCMWindowsFactory('selectedAllFile');
$text .= $windows_right_click_menu->setItemName('notepad++')
                                 ->setShowName('使用notepad++打开')
                                 ->setPath('E:\installed\Notepad++\notepad++.exe')
                                 ->create();

dump($text);