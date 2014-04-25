<?php
namespace Builder\Element;

class PhantomContainer extends Container
{
    public function getFirst()
    {
        $nested = $this->getNested();

        if (!count($nested)) {
            throw new \Exception('Phantom madness');
        }

        return $nested[0];
    }

    public function setAttribute($key, $value)
    {
        return $this->getFirst()->setAttribute($key, $value);
    }

    public function removeAttribute($key)
    {
        return $this->getFirst()->removeAttribute($key);
    }

    public function transferAttributes(Element $element)
    {
        return $this->getFirst()->transferAttributes($element);
    }

    public function appendAttribute($key, $value)
    {
        return $this->getFirst()->appendAttribute($key, $value);
    }

    public function setAttributes(array $attributes)
    {
        return $this->getFirst()->setAttributes($attributes);
    }

    public function getAttributes()
    {
        return $this->getFirst()->getAttributes();
    }

    public function renderAttributes()
    {
        return $this->getFirst()->renderAttributes();
    }

    public function render()
    {
        return '' . $this->renderNested() . '';
    }
}