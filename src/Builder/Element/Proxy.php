<?php
namespace Builder\Element;

use Builder\Element\Element;
use Builder\Element\ElementInterface;
use \InvalidArgumentException;

abstract class Proxy extends Element
{
    private $element;

    public function __construct(ElementInterface $element)
    {
        $this->element = $element;

        $resolved = $this->resolveProxy();
        $supported = $this->supported();

        // Check if element is supported
        if (!($resolved instanceof $supported)) {
            throw new InvalidArgumentException(
                'Unsupported type "' . get_class($resolved) . '" in proxy "' . get_class($this) . '"'
            );
        }
    }

    protected function setElement(ElementInterface $element)
    {
        $this->element = $element;
        return $this;
    }

    public function supported()
    {
        return 'Builder\Element\Element';
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










    public function unlink()
    {
        return $this->getElement()->unlink();
    }

    public function closest($container)
    {
        return $this->getElement()->closest($container);
    }

    public function inside($container)
    {
        return $this->getElement()->inside($container);
    }

    public function setParent(Container $parent)
    {
        return $this->getElement()->setParent($parent);
    }

    public function getParent()
    {
        return $this->getElement()->getParent();
    }

    public function getGuarded()
    {
        return $this->getElement()->getGuarded();
    }

    public function getUnguarded()
    {
        return $this->getElement()->getUnguarded();
    }

    public function wrap(Container $container)
    {
        return $this->getElement()->wrap();
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