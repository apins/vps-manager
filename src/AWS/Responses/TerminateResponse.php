<?php

namespace VpsManager\AWS\Responses;

use Aws\Result;
use VpsManager\Models\Instance;

class TerminateResponse
{

    private $terminatedInstances;

    /**
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->terminatedInstances = $result['TerminatingInstances'];
    }

    /**
     * @return array
     */
    public function getInstances()
    {
        return array_map(function ($instance) {
            return new Instance([
                'name' => $instance['InstanceId'],
                'address' => null,
            ]);
        }, $this->terminatedInstances);
    }
}