<?php

namespace RightClickMenu;

class AllShell extends RCMDepartment
{
    public function __construct(AttributeSet $attribute_set)
    {
        parent::__construct($attribute_set);
        $this->setItemPath('*\shell');
    }
}