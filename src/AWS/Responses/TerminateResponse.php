<?php

namespace VpsManager\AWS\Responses;

use Aws\Result;
use VpsManager\Entities\Instance;

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
                'id' => $instance['InstanceId'],
                'address' => null,
            ]);
        }, $this->terminatedInstances);
    }
}
