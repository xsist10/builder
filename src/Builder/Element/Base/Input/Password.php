<?php
namespace Builder\Element\Base\Input;

use Builder\Element\Base\Input;

class Password extends Input
{
    protected $attributes = array('type' => 'password');

    protected $guarded = array('type');
}