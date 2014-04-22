<?php
namespace Builder\Element\Proxy;

use Builder\Element\Element;
use Builder\Element\Proxy;

class Example extends Proxy
{
    private $example = "default";

    public function setExample($text)
    {
        $this->example = $text;
    }

    public function getExample()
    {
        return $this->example;
    }

    public function render()
    {
        $this->setAttribute('data-example', $this->getExample());

        return parent::render();
    }
}