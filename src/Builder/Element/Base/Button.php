<?php
namespace Builder\Element\Base;

use Builder\Element\Container;
use Builder\Element\Base\Literal;

abstract class Button extends Container
{
    public function __construct($text)
    {
        $this->literal = new Literal();
        $this->setText($text);

        $this->nest($this->literal);
    }

    public function setText($text)
    {
        $this->literal->setText($text);
    }

    public function getText()
    {
        return $this->literal->getText();
    }

    public function render()
    {
        return '<button' . $this->renderAttributes() . '>'
            . $this->renderNested()
            . '</button>' . PHP_EOL;
    }
}