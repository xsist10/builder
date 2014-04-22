<?php
namespace Builder\Element\Base;

use Builder\Element\Container;

class Paragraph extends Container
{
    public function render()
    {
        return "<p" . $this->renderAttributes() . ">"
            . $this->renderNested()
            . "</p>" . PHP_EOL;
    }
}