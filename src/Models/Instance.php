<?php

namespace VpsManager\Models;

class Instance
{
    public $name;
    public $address;

    public function __construct($attributes)
    {
        $this->name = array_key_exists('name', $attributes) ? $attributes['name'] : null;
        $this->address = array_key_exists('address', $attributes) ? $attributes['address'] : null;
    }
}
