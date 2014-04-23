<?php
namespace Builder\Element\Composite;

use Builder\Element\Base\Div;
use Builder\Element\Base\Label;
use Builder\Element\Base\Input;
use Builder\Element\Base\Paragraph;

class InputField extends Div
{
    private $label, $field;

    public function __construct($label, $name, Input $input)
    {
        $this->field = $input->setAttribute('name', $name);

        $this->label = new Label($label);
        $this->label->setAttribute('for', $name);

        $this->nest($this->label);
        $this->nest($this->field);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getInputText()
    {
        return $this->field;
    }
}