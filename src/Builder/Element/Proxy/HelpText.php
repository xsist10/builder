<?php
namespace Builder\Element\Proxy;

use Builder\Element\Base\Paragraph;
use Builder\Element\Base\Literal;
use Builder\Element\Base\Div;
use Builder\Element\ElementInterface;
use Builder\Element\Proxy;
use Builder\Element\Container;
use Builder\Element\PhantomContainer;

class HelpText extends Proxy
{
    private $paragraph;

    public function __construct(ElementInterface $element)
    {
        $this->paragraph = new Paragraph();
        parent::__construct($element);
    }

    public function setHelpText($text)
    {
        // Create the paragraph
        $this->paragraph->clear()->nest(new Literal($text));

        // Figure out if we are nested in a container
        if (!($this->resolveProxy() instanceof Container)) {
            // Replace the proxy element
            $div = new Div();
            $this->setElement($div->nest($this->getElement()));
        }

        // Nest the paragraph
        $this->resolveProxy()->nest($this->paragraph);

        return $this;
    }

    public function getParagraph()
    {
        return $this->paragraph;
    }
}