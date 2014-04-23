<?php
namespace Builder\Theme\Decorator;

use Builder\Theme\DecoratorInterface;
use Builder\Element\ElementInterface;
use Builder\Element\Container;
use Builder\Element\Proxy;

abstract class RecursiveDecorator implements DecoratorInterface
{
    private $callbacks = array();

    private function invokeTransformer(ElementInterface $element)
    {
        foreach ($this->callbacks as $namespace => $callback) {
            if ($element instanceof $namespace) {
                $element = call_user_func($callback, $element);
                break;
            }
        }

        // Unwrap any proxies
        if ($element instanceof Proxy) {
            $element = $this->invokeTransformer($element->getElement());
        }

        return $element;
    }

    private function recurse(ElementInterface $element)
    {
        if ($element instanceof Container) {

            $temp = array();

            foreach ($element->getNested() as $nested) {
                $temp[] = $this->recurse($nested);
            }

            $element = $this->invokeTransformer($element->setNested($temp));
        } else {

            // Do infinite recursion until no objects are unwrapped anymore
            $before = $element;
            $element = $this->invokeTransformer($element);

            if ($element != $before) {
                $element = $this->recurse($element);
            }
        }

        return $element;
    }

    public function transform($namespace, $callback)
    {
        $this->callbacks[$namespace] = $callback;
        return $this;
    }

    public function decorate(ElementInterface $element)
    {
        return $this->recurse($element);
    }
}