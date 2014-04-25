<?php
namespace Builder\Element\Proxy;

use Builder\Element\Base\Div;
use Builder\Element\Base\Label as LabelElement;
use Builder\Element\Base\Paragraph;

use Builder\Element\ElementInterface;
use Builder\Element\Proxy;

class Label extends Proxy
{
    private $label;

    public function __construct(ElementInterface $element)
    {
        $this->label = new LabelElement('');

        parent::__construct($element);
    }

    public function supported()
    {
        return 'Builder\Element\ElementInterface';
    }

    public function setLabelText($text)
    {
        $cont = new Div();
        $this->getLabel()->setText($text);

        $cont->nest($this->getLabel());
        $cont->nest($this->getElement());

        $this->setElement($cont);
    }

    public function getLabel()
    {
        return $this->label;
    }
}