<?php

namespace RightClickMenu;

class RCMDepartment extends HkeyClassesRoot
{
    /**
     * @var AttributeSet
     */
    protected $attribute_set;

    public function __construct(AttributeSet $attribute_set)
    {
        $this->setAttributeSet($attribute_set);
    }

    public function setAttributeSet(AttributeSet $attribute_set)
    {
        $this->attribute_set = $attribute_set;
    }

    public function generate()
    {
    }

    public function create()
    {
        $rcm_registry_item = '';

        $attribute_set = $this->attribute_set;

        $this->setInPathName($attribute_set->getRegistryName());

        $attributes = [
            '@' => $attribute_set->getMenuName(),
            'Extended' => $attribute_set->getExtend(),
            'Icon' => $attribute_set->getIcon(),
        ];

        foreach ($attributes as $k => $v) {
            $this->addAttr($k, $v);
        }

        $rcm_registry_item .= $this->createLogic();

        $this->resetAttr()->setInPathName($this->getInPathName().'\command');
        $this->addAttr('@', $attribute_set->getPath());

        $rcm_registry_item .= $this->createLogic();

        $this->setInPathName($attribute_set->getRegistryName());

        return $rcm_registry_item;
    }

    public function createLogic()
    {
        $attributes = $this->getAttributes();
        $item = "[{$this->getLocation()}]";

        foreach ($attributes as $k => $v) {
            $key = $k === '@' ? '@' : "\"$k\"";
            $item .= "\n{$key} = \"".addslashes($v)."\"";
        }

        return "{$item}\n\n";
    }

    public function remove()
    {
        return "[-{$this->getLocation()}]";
    }
}