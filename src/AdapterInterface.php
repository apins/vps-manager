<?php

namespace VpsManager;

interface AdapterInterface
{
    public function __construct(array $config);

    public function createInstances($count);

    public function describeInstances(array $ids);

    public function terminateInstances(array $ids);
}
