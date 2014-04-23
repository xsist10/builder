<?php
namespace Builder\Element;

class PhantomContainer extends Container
{
    public function setAttribute($key, $value)
    {
        throw new \Exception('');
    }

    public function removeAttribute($key)
    {
        throw new \Exception('');
    }

    public function transferAttributes(Element $element)
    {
        throw new \Exception('');
    }

    public function appendAttribute($key, $value)
    {
        throw new \Exception('');
    }

    public function setAttributes(array $attributes)
    {
        throw new \Exception('');
    }

    public function getAttributes()
    {
        throw new \Exception('');
    }

    public function renderAttributes()
    {
        throw new \Exception('');
    }

    public function render()
    {
        return '' . $this->renderNested() . '';
    }
}