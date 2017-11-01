<?php

namespace VpsManager;

interface AdapterInterface
{
    public function createInstances($count);

    public function describeInstances($names);

    public function terminateInstances($names);
}