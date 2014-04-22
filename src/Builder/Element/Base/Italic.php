<?php
namespace Builder\Element\Base;

use Builder\Element\Container;

class Italic extends Container
{
    public function render()
    {
        return "<i" . $this->renderAttributes() . ">"
            . $this->renderNested()
            . "</i>" . PHP_EOL;
    }
}