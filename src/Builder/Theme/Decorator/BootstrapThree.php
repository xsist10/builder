<?php
namespace Builder\Theme\Decorator;

use Builder\Theme\Decorator\RecursiveDecorator;
use Builder\Element\Base\Label;
use Builder\Element\Base\Div;
use Builder\Element\Base\Form;
use Builder\Element\Base\Button;
use Builder\Element\Base\Italic;
use Builder\Element\Composite\InputField;

use Builder\Element\Proxy\Example;
use Builder\Element\Proxy\HelpText;

class BootstrapThree extends RecursiveDecorator
{
    public function __construct()
    {
        // Base elements
        $this->transform('Builder\Element\Base\Form', array($this, 'transformForm'));
        $this->transform('Builder\Element\Base\Button', array($this, 'transformButton'));

        // Composite elements
        $this->transform('Builder\Element\Composite\InputField', array($this, 'transformInputField'));

        // Proxy elements (override)
        $this->transform('Builder\Element\Proxy\Example', array($this, 'transformExample'));
        $this->transform('Builder\Element\Proxy\HelpText', array($this, 'transformHelpText'));
    }

    public function transformForm(Form $form)
    {
        $form->setAttribute('role', 'form');

        return $form;
    }

    public function transformInputField(InputField $textField)
    {
        $textField
            ->getInputText()
            ->appendAttribute('class', 'form-control');

        $div = new Div();
        $div->transferAttributes($textField)
            ->appendAttribute('class', 'form-group')
            ->nest($textField);

        return $div;
    }

    public function transformButton(Button $button)
    {
        $button->appendAttribute('class', 'btn btn-primary');
        return $button;
    }

    public function transformExample(Example $example)
    {
        $example->removeAttribute('data-example');
        return $example;
    }

    public function transformHelpText(HelpText $helpText)
    {
        $helpText->getParagraph()->setAttribute('class', 'help-block');
        return $helpText;
    }
}