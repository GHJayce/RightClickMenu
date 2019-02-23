<?php

require './autoload.php';

$data = [
    [
        'registry_name' => 'CopyPath',
        'menu_name' => '复制目标路径',
        'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
        'icon' => '%SYSTEMROOT%\explorer.exe',
        'department' => [1, 2],
        'extend' => [1, 0],
    ],
    [
        'registry_name' => 'Cmder',
        'menu_name' => 'Cmder here',
        'path' => 'F:\installed\cmder\Cmder.exe',
        'icon' => '',
        'department' => [3],
        'extend' => [1],
    ],
];

$copy_writeting = [
    'registry_name' => '注册表名',
    'menu_name' => '右键菜单名',
    'path' => '程序路径',
    'department' => '右键菜单位置',
];
$require = ['registry_name', 'menu_name', 'path', 'department'];

foreach ($data as $v) {
    foreach ($require as $rv) {
        if (empty($v[$rv])) {
            new \Exception($copy_writeting[$rv].'参数必填');
        }
    }
}

$right_click_menu = new \service\RightClickMenu($data);
dump($right_click_menu->generate());