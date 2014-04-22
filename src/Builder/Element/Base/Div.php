<?php
namespace Builder\Element\Base;

use Builder\Element\Container;

class Div extends Container
{
    public function render()
    {
        return '<div' . $this->renderAttributes() . '>' . PHP_EOL
            . $this->renderNested()
            . '</div>' . PHP_EOL;
    }
}