<?php
namespace Builder\Theme\Decorator;

use Builder\Theme\DecoratorInterface;
use Builder\Element\ElementInterface;

class ChainDecorator implements DecoratorInterface
{
    private $chain = array();

    public function addDecorator(DecoratorInterface $decorator)
    {
        $this->chain[] = $decorator;
        return $this;
    }

    public function decorate(ElementInterface $element)
    {
        foreach ($this->chain as $decorator) {
            $element = $decorator->decorate($element);
        }

        return $element;
    }
}