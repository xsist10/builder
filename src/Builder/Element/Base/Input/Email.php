<?php
namespace Builder\Element\Base\Input;

use Builder\Element\Base\Input;

class Email extends Input
{
    protected $attributes = array('type' => 'email');

    protected $guarded = array('type');
}