<?php
namespace Builder\Element\Base\Input;

use Builder\Element\Base\Input;

class File extends Input
{
    protected $attributes = array('type' => 'file');

    protected $guarded = array('type');
}