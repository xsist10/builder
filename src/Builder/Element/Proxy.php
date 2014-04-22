<?php
namespace Builder\Element;

use Builder\Element\Element;
use Builder\Element\ProxyInterface;

abstract class Proxy extends Element
{
    private $element;

    public function __construct(Element $element)
    {
        $this->element = $element;
    }

    public function getElement()
    {
        return $this->element;
    }

    public function removeAttribute($key)
    {
        $this->getElement()->removeAttribute($key);
    }

    public function setAttribute($key, $value)
    {
        return $this->getElement()->setAttribute($key, $value);
    }

    public function transferAttributes(Element $element)
    {
        return $this->getElement()->transferAttributes($key, $value);
    }

    public function appendAttribute($key, $value)
    {
        return $this->getElement()->appendAttribute($key, $value);
    }

    public function setAttributes(array $attributes)
    {
        return $this->getElement()->setAttributes($attributes);
    }

    public function getAttributes()
    {
        return $this->getElement()->getAttributes();
    }

    public function renderAttributes()
    {
        return $this->getElement()->renderAttributes();
    }

    public function render()
    {
        return $this->element->render();
    }
}