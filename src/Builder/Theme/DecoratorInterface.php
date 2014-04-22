<?php
namespace Builder\Theme;

use Builder\Element\ElementInterface;

interface DecoratorInterface
{
    public function decorate(ElementInterface $element);
}