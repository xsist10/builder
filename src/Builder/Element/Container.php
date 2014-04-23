<?php
namespace Builder\Element;

abstract class Container extends Element implements ContainerInterface
{
    private $nested = array();

    public function nest(ElementInterface $element)
    {
        $this->nested[] = $element;
        return $this;
    }

    public function getNested()
    {
        return $this->nested;
    }

    public function setNested(array $elements)
    {
        $this->nested = $elements;
        return $this;
    }

    public function clear()
    {
        $this->nested = array();
        return $this;
    }

    public function unwrap()
    {
        $container = new PhantomContainer();
        $container->setNested($this->getNested());
        return $container;
    }

    public function renderNested()
    {
        $return = "";

        foreach ($this->getNested() as $nested) {
            $return .= $nested->render();
        }

        return $return;
    }
}