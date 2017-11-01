<?php

namespace VpsManager\AWS\Responses;

use Aws\Result;
use VpsManager\Entities\Instance;

class DescribeResponse
{
    private $instances;

    /**
     * @param Result $result
     */
    public function __construct(Result $result)
    {
        $this->instances = $result['Reservations'][0]['Instances'];
    }

    /**
     * @return array
     */
    public function getInstances()
    {
        return array_map(function ($instance) {
            return new Instance([
                'id' => $instance['InstanceId'],
                'address' => array_key_exists('PublicIpAddress', $instance) ? $instance['PublicIpAddress'] : null
            ]);
        }, $this->instances);
    }
}
