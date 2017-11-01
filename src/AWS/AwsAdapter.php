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
    public function __construct(array $config)
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
     * @param array $ids
     * @return array
     */
    public function describeInstances(array $ids)
    {
        $response = $this->callDescribeInstances($ids);

        return (new DescribeResponse($response))->getInstances();
    }

    /**
     * @param array $ids
     * @return array
     */
    public function terminateInstances(array $ids)
    {
        $response = $this->callTerminateInstances($ids);

        return (new TerminateResponse($response))->getInstances();
    }

    /**
     * @param array $config
     * @param integer $count
     * @return Result
     */
    private function callRunInstances(array $config, $count)
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
     * @param array $ids
     * @return Result
     */
    private function callDescribeInstances(array $ids)
    {
        return $this->client->describeInstances([
            'Filters' => [
                [
                    'Name' => 'instance-id',
                    'Values' => $ids
                ]
            ]
        ]);
    }

    /**
     * @param array $ids
     * @return Result
     */
    private function callTerminateInstances(array $ids)
    {
        return $this->client->terminateInstances([
            'InstanceIds' => $ids
        ]);
    }
}
