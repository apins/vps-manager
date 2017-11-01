<?php

namespace VpsManager\Entities;

class Instance
{
    public $id;
    public $address;

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        $this->id = array_key_exists('id', $attributes) ? $attributes['id'] : null;
        $this->address = array_key_exists('address', $attributes) ? $attributes['address'] : null;
    }
}
