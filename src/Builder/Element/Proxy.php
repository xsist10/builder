<?php
namespace Builder\Element;

use Builder\Element\Element;
use Builder\Element\ElementInterface;

abstract class Proxy extends Element
{
    protected $element;

    public function __construct(Element $element)
    {
        // Check if element is supported
        $this->supported($element);
        $this->element = $element;
    }

    public function supported(ElementInterface $element)
    {
        // By default we want to use attributes
        if (!($element instanceof Element)) {
            throw new \Exception('unsupported type');
        }
    }

    public function getElement()
    {
        return $this->element;
    }

    public function resolveProxy()
    {
        if ($this->element instanceof Proxy) {
            return $this->element->resolveProxy();
        } else {
            return $this->element;
        }
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

    final public function render()
    {
        return $this->element->render();
    }
}