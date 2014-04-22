<?php
namespace Builder\Theme\Decorator;

use Builder\Theme\DecoratorInterface;
use Builder\Element\ElementInterface;
use Builder\Element\Base\Literal;
use Symfony\Component\DomCrawler\Crawler;

abstract class DomDecorator implements DecoratorInterface
{
    public function getCrawler($content)
    {
        return new Crawler($content);
    }

    public function decorateContent($content)
    {
        return $content;
    }

    final public function decorate(ElementInterface $element)
    {
        $content = $element->render();
        $content = $this->decorateContent($content);
        return new Literal($content);
    }
}