<?php

namespace VpsManager;

abstract class BaseAdapter implements AdapterInterface
{
    protected $client;
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }
}
