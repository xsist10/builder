<?php
namespace Builder\Element;

use \InvalidArgumentException;

abstract class Element implements ElementInterface
{
    protected $attributes = array();

    protected $guarded = array();

    public function setAttribute($key, $value)
    {
        if (in_array($key, $this->guarded)) {
            throw new InvalidArgumentException(
                'Parameter "' . $key . '" is read-only.'
            );
        }

        $this->attributes[$key] = $value;
        return $this;
    }

    public function removeAttribute($key)
    {
        unset($this->attributes[$key]);
        return $this;
    }

    public function transferAttributes(Element $element)
    {
        $this->setAttributes($element->getAttributes());
        return $this;
    }

    public function appendAttribute($key, $value)
    {
        $current = "";

        if (isset($this->attributes[$key])) {
            $current = $this->attributes[$key] . " ";
        }

        return $this->setAttribute($key, $current . $value);
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = array_merge(
            $this->attributes,
            $attributes
        );

        return $this;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function renderAttributes()
    {
        $return = "";

        foreach ($this->attributes as $key => $value)
        {
            $return .= " " . $key . "='" . $value . "'";
        }

        return $return;
    }
}