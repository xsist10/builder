<?php
namespace Builder\Element;

use Builder\Element\ElementInterface;

interface ContainerInterface extends ElementInterface
{
    public function nest(ElementInterface $element);

    public function getNested();

    public function setNested(array $elements);

    public function renderNested();
}