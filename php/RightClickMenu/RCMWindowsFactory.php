<?php

namespace php\RightClickMenu;

use php\RightClickMenu\RCMWindows;

class RCMWindowsFactory extends RCMFactoryMethod
{
    public function getVersion()
    {
        return RCMWindows::$version;
    }

    protected function generate(string $target)
    {
        $right_click_menu = [
            'background' => new RCMWindowsBackground(),
            'selectedDirectory' => new RCMWindowsSelectedDirectory(),
            'selectedAllFile' => new RCMWindowsSelectedAllFile()
        ];

        if (empty(isset($right_click_menu[$target]))) {
            exit('暂无此右键菜单方法');
        }

        return $right_click_menu[$target];
    }
}
