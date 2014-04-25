<?php
namespace Builder\Element;

abstract class Container extends Element implements ContainerInterface
{
    private $nested = array();

    public function nestUnshift(ElementInterface $element)
    {
        $this->nestAt(0, $element);
        return $this;
    }

    public function nest(ElementInterface $element)
    {
        $this->nestAt(count($this->nested), $element);
        return $this;
    }

    public function nestAt($index, ElementInterface $element)
    {
        array_splice($this->nested, $index, 0, array($element));
        $element->setParent($this);
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

    public function remove(ElementInterface $element)
    {
        foreach ($this->nested as $key => $item) {
            if ($item == $element) {
                unset($this->nested[$key]);
                if ($element->getParent() == $this) {
                    $element->unlink();
                }
                return $key;
            }
        }

        return false;
    }

    public function clear()
    {
        foreach ($this->nested as $element) {
            $this->remove($element);
        }

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