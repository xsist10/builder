<?php
namespace Builder\Element\Base\Input;

use Builder\Element\Base\Input;

class Text extends Input
{
    protected $attributes = array('type' => 'text');

    protected $guarded = array('type');
}