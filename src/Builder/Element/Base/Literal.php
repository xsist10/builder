<?php
namespace Builder\Element\Base;

use Builder\Element\Element;

class Literal extends Element
{
    private $text;

    public function __construct($text = '')
    {
        $this->text = $text;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function render()
    {
        return $this->text;
    }
}