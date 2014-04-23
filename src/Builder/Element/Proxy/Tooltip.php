<?php
namespace Builder\Element\Proxy;

use Builder\Element\ElementInterface;
use Builder\Element\Proxy;

class Tooltip extends Proxy
{
    private $tooltipText = '';
    private $tooltipPosition = '';

    public function __construct(ElementInterface $element)
    {
        parent::__construct($element);

        // Defaults
        $this->setAttribute('data-toggle', 'tooltip');
        $this->setTooltipPosition('left');
    }

    public function setTooltipText($text)
    {
        return $this->setAttribute('title', $text);
    }

    public function getTooltipText()
    {
        return $this->getAttribute('title');
    }

    public function setTooltipPosition($pos)
    {
        return $this->setAttribute('data-placement', $pos);
    }

    public function getTooltipPosition()
    {
        return $this->getAttribute('data-placement');
    }
}