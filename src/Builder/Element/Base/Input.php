<?php
namespace Builder\Element\Base;

use Builder\Element\Element;

abstract class Input extends Element
{
    public function __construct($name = '')
    {
        $this->setAttribute('name', $name);
    }

    public function render()
    {
        return '<input' . $this->renderAttributes() . ' />';
    }
}