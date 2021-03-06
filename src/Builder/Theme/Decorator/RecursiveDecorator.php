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
        foreach ($this->callbacks as $namespace => $calls) {
            if ($element instanceof $namespace) {
                foreach ($calls as $key => $callback) {
                    $element = call_user_func($callback, $element);
                }

                break;
            }
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

        } elseif ($element instanceof Proxy) {
            $element = $this->invokeTransformer($element);
            $element = $this->recurse($element->getElement());
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
        if (!isset($this->callbacks[$namespace])) {
            $this->callbacks[$namespace] = array();
        }

        $this->callbacks[$namespace][] = $callback;
        return $this;
    }

    public function decorate(ElementInterface $element)
    {
        return $this->recurse($element);
    }
}