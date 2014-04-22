<?php
namespace Builder\Element\Base\Button;

use Builder\Element\Base\Button;

class Submit extends Button
{
    protected $attributes = array('type' => 'submit');

    protected $guarded = array('type');
}