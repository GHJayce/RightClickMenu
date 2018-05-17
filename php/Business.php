<?php

namespace php;

use php\RightClickMenu\RCMWindows;
use php\RightClickMenu\RCMWindowsBackground;
use php\RightClickMenu\RCMWindowsSelectedAllFile;
use php\RightClickMenu\RCMWindowsSelectedDirectory;
use ZipArchive;

class Business
{
    // 右键菜单对应注册表项
    protected function rightMenu(RCMWindows $rcm_windows_config)
    {
        return [
            1 => new RCMWindowsBackground($rcm_windows_config),
            new RCMWindowsSelectedDirectory($rcm_windows_config),
            new RCMWindowsSelectedAllFile($rcm_windows_config),
        ];
    }

    // 主要业务逻辑
    public function main(string $item_name, string $show_name, string $path, string $icon, array $extended, array $options)
    {
        $rcm_windows_config = new RCMWindows();
        $rcm_windows_config->setItemName($item_name)->setShowName($show_name)->setPath($path)->setIcon($icon);

        $right_menu = $this->rightMenu($rcm_windows_config);

        $version = $rcm_windows_config->getVersion();

        $create_reg_text = $version;
        $remove_reg_text = $version;

        foreach (json_decode($_POST['options']) as $v) {
            $right_menu[$v]->setExtended($extended[$v] == 'no' ? null : $extended[$v]);

            $create_reg_text .= $right_menu[$v]->create();
            $remove_reg_text .= $right_menu[$v]->remove();
        }

        $this->bale($create_reg_text, $remove_reg_text);

        return [
            'create_reg_text' => $create_reg_text,
            'remove_reg_text' => $remove_reg_text,
        ];
    }

    // 打包注册表文件到根目录
    private function bale($create_reg_text, $remove_reg_text)
    {
        $zip = new ZipArchive();

        $res = $zip->open('../register_table_file.zip', ZipArchive::OVERWRITE | ZipArchive::CREATE);

        if ($res) {
            $zip->addFromString('create_right_click_memu.reg', iconv('utf-8', 'gb2312', $create_reg_text));
            $zip->addFromString('remove_right_click_menu.reg', iconv('utf-8', 'gb2312', $remove_reg_text));
        }

        $zip->close();
    }
}
