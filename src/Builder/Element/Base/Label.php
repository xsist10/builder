<?php
namespace Builder\Element\Base;

use Builder\Element\Container;

class Label extends Container
{
    private $literal;

    public function __construct($text)
    {
        $this->literal = new Literal($text);

        // Add the literal to the container
        $this->nest($this->literal);
    }

    public function setText($text)
    {
        $this->literal->setText($text);
        return $this;
    }

    public function getText()
    {
        return $this->literal->getText();
    }

    public function render()
    {
        return '<label' . $this->renderAttributes() . '>'
            . $this->renderNested()
            . '</label>' . PHP_EOL;
    }
}