<?php
namespace Builder\Element\Base;

use Builder\Element\Element;
use Builder\Element\Base\Literal;

abstract class Button extends Element
{
    private $text;

    public function __construct($text)
    {
        $this->setText($text);
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function render()
    {
        return '<button' . $this->renderAttributes() . '>'
            . $this->text
            . '</button>' . PHP_EOL;
    }
}