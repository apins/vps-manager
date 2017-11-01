<?php

namespace VpsManager\AWS\Responses;

use Aws\Result;
use VpsManager\Entities\Instance;

class CreateResponse
{
    private $instances;

    /**
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->instances = $result['Instances'];
    }

    /**
     * @return array
     */
    public function getInstances()
    {
        return array_map(function ($instance) {
            return new Instance([
                'id' => array_key_exists('InstanceId', $instance) ? $instance['InstanceId'] : null,
                'address' => array_key_exists('PublicIpAddress', $instance) ? $instance['PublicIpAddress'] : null
            ]);
        }, $this->instances);
    }
}
