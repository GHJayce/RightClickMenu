<?php

namespace RightClickMenu;

class Test
{
    public function generate()
    {
        $attributes = new RCMAttributes();
        $attributes->setRegistryName('CopyPath')
            ->setMenuName('复制目标路径')
            ->setPath('mshta vbscript:clipboarddata.setdata("text","%1")(close)')
            ->setIcon('%SYSTEMROOT%\explorer.exe')
            ->setExtend('');

        $create_operator = new CreateRegistryItem();
        $remove_operator = new RemoveRegistryItem();

//        $service = new RightClickMenu(new DirectoryShell($attributes));
//        $create_registry_str = $service->generate();
//        $remove_registry_str = $service->setRegistryItemOperator($remove_operator)->generate();

        $directory_shell = new DirectoryShell($attributes);
        $all_shell = new AllShell($attributes);

        $registry = new Registry($create_operator);
        $registry->addItem($directory_shell);
        $registry->addItem($all_shell);
        $create_registry = $registry->generate();
        $registry = new Registry($remove_operator);
        $registry->addItem($directory_shell);
        $registry->addItem($all_shell);
        $remove_registry = $registry->generate();

        print_r($create_registry);
        print_r($remove_registry);
    }
}