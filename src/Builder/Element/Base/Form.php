<?php
namespace Builder\Element\Base;

use Builder\Element\Container;

class Form extends Container
{
    public function render()
    {
        return '<form' . $this->renderAttributes() . '>' . PHP_EOL
            . $this->renderNested()
            . '</form>' . PHP_EOL;
    }
}