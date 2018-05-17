<?php

namespace php\RightClickMenu;

abstract class HkeyClassesRoot
{
    private $config;
    protected $target;

    public function __construct(RCMWindows $RCMWindows)
    {
        $this->config = $RCMWindows;
    }

    // 得到注册表位置，这里的路径改造一下可以适应多个注册表位置
    protected function getPosition()
    {
        return "HKEY_CLASSES_ROOT\\$this->target\\shell\\{$this->config->getItemName()}";
    }

    // 设置拓展
    public function setExtended($extended = null)
    {
        $this->config->setExtended($extended);
    }

    // 注册表创建模板
    protected function createTemplate()
    {
        $position = $this->getPosition();

        $extended = $this->config->getExtended();
        $extended = isset($extended) ? "\"Extended\" = \"$extended\"" : '';

        $str = <<<EOS
    
    
[$position]
@ = "{$this->config->getShowName()}"
$extended
"Icon" = "{$this->config->getIcon()},0"

[$position\command]
@ = "{$this->config->getPath()} %1"
    
EOS;

        return $str;
    }

    // 注册表删除模板
    protected function removeTemplate()
    {
        return <<<EOS
    
[-{$this->getPosition()}]
    
EOS;
    }

    public function create()
    {
        return $this->createTemplate();
    }

    public function remove()
    {
        return $this->removeTemplate();
    }

}
