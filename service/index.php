<?php

require './autoload.php';

date_default_timezone_set('PRC');

// 请求的数据格式
/*
{
    "91":{
        "registry_name":"711529c59aaa3088d3c6cbf0fd0188ab",
        "menu_name":"工具箱",
        "children":[

        ],
        "departments":[
            1,
            2,
            4
        ],
        "pid":0,
        "id":91
    },
    "92":{
        "registry_name":"adb5d8e6729e13eb5596943cb23a20ec",
        "menu_name":"实用功能",
        "children":[

        ],
        "pid":91,
        "id":92
    },
    "93":{
        "registry_name":"b16b3cf4fe9c8a9fbbcfac30b2c73a5a",
        "menu_name":"复制目标路径",
        "origin_registry_name":"copy-target-path",
        "icon":"%SYSTEMROOT%\explorer.exe",
        "pid":92,
        "path":"mshta vbscript:clipboarddata.setdata("text","%1")(close)",
        "id":93
    }
}
*/

$data = $_POST['data'];

$data = json_decode($data, true);

// 验证必填数据
if (empty($data)) {
    response_error('参数不能为空');
}

$require = [
    'common' => ['registry_name', 'menu_name', 'id'],
    'text' => '参数必填',
];

$copy_writeting = [
    'registry_name' => '注册表名',
    'menu_name' => '右键菜单名',
    'path' => '程序路径',
    'departments' => '右键菜单位置',
    'id' => 'id',
    'pid' => '上级id',
];

foreach ($data as $v) {
    foreach ($require['common'] as $rv) {
        if (empty($v[$rv])) {
            response_error($copy_writeting[$rv].$require['text']);
        }
    }
    !isset($v['pid']) && response_error($copy_writeting['pid'].$require['text']);
    ($v['pid'] == 0 && empty($v['departments'])) && response_error($copy_writeting['departments'].$require['text']);
    (!empty($v['origin_registry_name']) && empty($v['path'])) && response_error($copy_writeting['path'].$require['text']);
}

// 转化为树状结构
$data = to_tree($data);

// 生成注册表文件
$right_click_menu = new \service\RightClickMenu($data);
$registry_list = $right_click_menu->generate();


// 打包zip
$save_dir = __DIR__.DIRECTORY_SEPARATOR;
$save_path = 'download'.DIRECTORY_SEPARATOR;
if (!file_exists($save_dir.$save_path)) {
    mkdir($save_dir.$save_path);
}
$zip_path = $save_path.'RightClickMenu_'.date('Y-m-d_H.i.s').'.zip';
$zip_file_path = $save_dir.$zip_path;

$zip = new ZipArchive();
$zip_file = $zip->open($zip_file_path, ZipArchive::OVERWRITE | ZipArchive::CREATE);
if ($zip_file) {
    $zip->addFromString('create_right_click_menu.reg', iconv('utf-8', 'gb2312', $registry_list['create']));
    $zip->addFromString('remove_right_click_menu.reg', iconv('utf-8', 'gb2312', $registry_list['remove']));
}
$zip->close();


response_success(array_merge($registry_list, ['path' => 'service/'.$zip_path]));