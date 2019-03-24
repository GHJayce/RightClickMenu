<?php

require './autoload.php';

$data = [
    [
        'registry_name' => 'cascadeDemo',
        'menu_name' => '我的级联菜单演示',
        'icon' => '%SYSTEMROOT%\explorer.exe',
        'department' => [1, 2],
        'extend' => [1, 0],
        'children' => [
            [
                'registry_name' => 'IAmChildren',
                'menu_name' => '子菜单一',
                'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
                'icon' => '%SYSTEMROOT%\explorer.exe',
            ],
            [
                'registry_name' => 'IAmChildren2',
                'menu_name' => '子菜单二',
                'icon' => '%SYSTEMROOT%\explorer.exe',
                'children' => [
                    [
                        'registry_name' => 'IAmChildren3',
                        'menu_name' => '子菜单三',
                        'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
                        'icon' => '%SYSTEMROOT%\explorer.exe',
                    ],
                ],
            ],
        ],
    ],
//    [
//        'registry_name' => 'CopyPath',
//        'menu_name' => '复制目标路径',
//        'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
//        'icon' => '%SYSTEMROOT%\explorer.exe',
//        'department' => [1, 2],
//        'extend' => [1, 0],
//        'children' => [
//            [
//                'registry_name' => 'IAmChildren',
//                'menu_name' => '子菜单一',
//                'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
//                'icon' => '%SYSTEMROOT%\explorer.exe',
//            ],
//            [
//                'registry_name' => 'IAmChildren2',
//                'menu_name' => '子菜单二',
//                'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
//                'icon' => '%SYSTEMROOT%\explorer.exe',
//            ],
//        ],
//    ],
    [
        'registry_name' => 'IAmChildren-2',
        'menu_name' => '我的单菜单演示2',
        'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
        'icon' => '%SYSTEMROOT%\explorer.exe',
        'department' => [3],
        'extend' => [1],
    ],
    [
        'registry_name' => 'IAmChildren-3',
        'menu_name' => '我的单菜单演示3',
        'path' => 'mshta vbscript:clipboarddata.setdata("text","%1")(close)',
        'icon' => '%SYSTEMROOT%\explorer.exe',
        'department' => [2, 3],
        'extend' => [0, 1],
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