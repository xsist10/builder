<?php
namespace Builder\Element\Proxy;

use Builder\Element\Element;
use Builder\Element\Proxy;

class Tooltip extends Proxy
{
    private $tooltipText, $tooltipPosition = 'left';

    public function setTooltipText($text)
    {
        $this->tooltipText = $text;
    }

    public function getTooltipText()
    {
        return $this->tooltipText;
    }

    public function getTooltipPosition()
    {
        return $this->tooltipPosition;
    }

    public function render()
    {
        $this->setAttribute('data-toggle', 'tooltip');
        $this->setAttribute('title', $this->getTooltipText());
        $this->setAttribute('data-placement', $this->getTooltipPosition());

        return parent::render();
    }
}