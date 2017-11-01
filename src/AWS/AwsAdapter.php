<?php

namespace VpsManager\AWS;

use Aws\Ec2\Ec2Client;
use Aws\Result;
use VpsManager\AdapterInterface;
use VpsManager\AWS\Responses\DescribeResponse;
use VpsManager\AWS\Responses\TerminateResponse;
use VpsManager\BaseAdapter;
use VpsManager\AWS\Responses\CreateResponse;

class AwsAdapter extends BaseAdapter implements AdapterInterface
{

    /**
     * @param $config
     * structure of config [
     *    'region'
     *    'key'
     *    'secret'
     *    'instance-type'
     *    'image-id'
     *    'key-name'
     *    'security-groups'
     * ]
     */
    public function __construct($config)
    {
        $this->config = $config;

        $this->client = new Ec2Client([
            'region' => $config['region'],
            'version' => $config['version'],
            'credentials' => [
                'key' => $config['key'],
                'secret' => $config['secret'],
            ]
        ]);
    }

    /**
     * @param integer $count
     * @return array
     */
    public function createInstances($count)
    {
        $response = $this->callRunInstances($this->config, $count);

        return (new CreateResponse($response))->getInstances();
    }

    /**
     * @param array $names
     * @return array
     */
    public function describeInstances($names)
    {
        $response = $this->callDescribeInstances($names);

        return (new DescribeResponse($response))->getInstances();
    }

    /**
     * @param $names
     * @return array
     */
    public function terminateInstances($names)
    {
        $response = $this->callTerminateInstances($names);

        return (new TerminateResponse($response))->getInstances();
    }

    /**
     * @param array $config
     * @param integer $count
     * @return Result
     */
    private function callRunInstances($config, $count)
    {
        return $this->client->runInstances([
            'ImageId' => $config['image-id'],
            'MinCount' => 1,
            'MaxCount' => $count,
            'InstanceType' => $config['instance-type'],
            'KeyName' => $config['key-name'],
            'SecurityGroups' => $config['security-groups'],
        ]);
    }

    /**
     * @param array $names
     * @return Result
     */
    private function callDescribeInstances($names)
    {
        return $this->client->describeInstances([
            'Filters' => [
                [
                    'Name' => 'instance-id',
                    'Values' => $names
                ]
            ]
        ]);
    }

    /**
     * @param $names
     * @return Result
     */
    private function callTerminateInstances($names)
    {
        return $this->client->terminateInstances([
            'InstanceIds' => $names
        ]);
    }
}