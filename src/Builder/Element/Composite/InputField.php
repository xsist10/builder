<?php
namespace Builder\Element\Composite;

use Builder\Element\Container;
use Builder\Element\Base\Label;
use Builder\Element\Base\Input;
use Builder\Element\Base\Paragraph;

class InputField extends Container
{
    private $label, $field, $helpText;

    public function __construct($label, $name, Input $input)
    {
        $this->field = $input->setAttribute('name', $name);

        $this->label = new Label($label);
        $this->label->setAttribute('for', $name);

        $this->helpText = new Paragraph();

        $this->nest($this->label);
        $this->nest($this->field);
        $this->nest($this->helpText);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getInputText()
    {
        return $this->field;
    }

    public function getHelpText()
    {
        return $this->helpText;
    }

    public function render()
    {
        return $this->renderNested() . PHP_EOL;
    }
}