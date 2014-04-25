<?php
namespace Builder\Element;

interface ElementInterface
{
    public function unlink();
    public function setParent(Container $container);
    public function getParent();
    public function render();
}