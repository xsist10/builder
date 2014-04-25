<?php
namespace Builder\Element\Proxy;

use Builder\Element\Composite\InputField;
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
        parent::__construct($element);

        $this->paragraph = new Paragraph();
        $this->nestHelpText();
    }

    private function nestHelpText()
    {
        // Figure out if we are nested in a container
        if (!($this->resolveProxy() instanceof Container)) {
            // Replace the proxy element
            $div = new Div();
            $this->setElement($div->nest($this->getElement()));
        }

        // Nest the paragraph
        $this->resolveProxy()->nest($this->paragraph);
    }

    public function supported()
    {
        return 'Builder\Element\Element';
    }

    public function setHelpText($text)
    {
        // Create the paragraph
        $this->paragraph->clear()->nest(new Literal($text));
        return $this;
    }

    public function getParagraph()
    {
        return $this->paragraph;
    }
}