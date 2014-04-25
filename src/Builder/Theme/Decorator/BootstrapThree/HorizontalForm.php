<?php
namespace Builder\Theme\Decorator\BootstrapThree;

use Builder\Theme\Decorator\RecursiveDecorator;
use Builder\Element\Base\Label;
use Builder\Element\Base\Div;
use Builder\Element\Base\Form;
use Builder\Element\Base\Button;
use Builder\Element\Base\Italic;
use Builder\Element\Composite\InputField;

use Builder\Element\Proxy\Example;
use Builder\Element\Proxy\HelpText;

class HorizontalForm extends RecursiveDecorator
{
    public function __construct()
    {
        // Base elements
        $this->transform('Builder\Element\Base\Form', array($this, 'transformForm'));

        // Composite elements
        $this->transform('Builder\Element\Composite\InputField', array($this, 'transformInputField'));

        // Proxy
        $this->transform('Builder\Element\Proxy\HelpText', array($this, 'transformHelpText'));
    }

    public function transformForm(Form $form)
    {
        $form->appendAttribute('class', 'form-horizontal');

        return $form;
    }

    public function transformHelpText(HelpText $helpText)
    {
        if ($helpText->inside('Builder\Element\Composite\InputText')) {
            var_dump('asd');
        }

        return $helpText;
    }

    public function transformInputField(InputField $textField)
    {
        $input = $textField->getInputText();
        $label = $textField->getLabel();

        switch (true) {
            case $input instanceof \Builder\Element\Base\Input\Checkbox:
                $textField = $parent->wrap(new Div())->setAttribute('class', 'col-sm-offset-2 col-sm-10');
                break;
            default:
                $input->wrap(new Div())->setAttribute('class', 'col-sm-10');
                $label->appendAttribute('class', 'col-sm-2 control-label');
                break;
        }

        return $textField;
    }
}