<?php
namespace Builder\Element;

use \InvalidArgumentException;

abstract class Element implements ElementInterface
{
    private $parent, $sticky;

    protected $attributes = array();

    protected $guarded = array();

    public function unlink()
    {
        $index = $this->parent->remove($this);
        $this->parent = null;
        return $index;
    }

    public function closest($container)
    {
        while ($parent = $this->getParent())
        {
            if ($parent instanceof $container) {
                return $parent;
            }
        }

        return false;
    }

    public function inside($container)
    {
        return $this->closest($container);
    }

    public function setParent(Container $parent)
    {
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function getGuarded()
    {
        return $this->guarded;
    }

    public function getUnguarded()
    {
        return array_diff_key($this->attributes, array_keys($this->guarded));
    }

    public function wrap(Container $container)
    {
        $temp = $this->parent;
        $index = $this->unlink();
        $container->nest($this);

        $temp->nestAt($index, $container);
        return $container;
    }

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

    public function clearAttributes()
    {
        foreach ($this->getUnguarded() as $key => $value) {
            $this->removeAttribute($key);
        }

        return $this;
    }

    public function removeAttribute($key)
    {
        unset($this->attributes[$key]);
        return $this;
    }

    public function transferAttributes(Element $element)
    {
        $this->setAttributes($element->getUnguarded());
        $element->clearAttributes();
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

    public function dumpTree()
    {
        $recurse = function (ElementInterface $element, $depth) use (&$recurse) {
            $class = get_class($element);
            $result = str_pad($class, strlen($class) + $depth, "-", STR_PAD_LEFT) . PHP_EOL;

            if ($element instanceof Container) {
                foreach ($element->getNested() as $nest) {
                    $result .= $recurse($nest, $depth + 1);
                }
            }

            if ($element instanceof Proxy) {
                $result .= $recurse($element->getElement(), $depth + 1);
            }

            return $result;
        };

        return $recurse($this, 0);
    }
}