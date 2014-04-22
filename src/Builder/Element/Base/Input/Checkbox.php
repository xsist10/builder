<?php
namespace Builder\Element\Base\Input;

use Builder\Element\Base\Input;

class Checkbox extends Input
{
    protected $attributes = array('type' => 'checkbox');

    protected $guarded = array('type');
}