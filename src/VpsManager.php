<?php

namespace VpsManager;

class VpsManager
{

    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Creates $count instances
     *
     * @param integer $count
     * @return mixed
     */
    public function createInstances($count)
    {
        return $this->adapter->createInstances($count);
    }

    /**
     * Describe $count instances
     *
     * @param array $names
     * @return mixed
     */
    public function describeInstances($names)
    {
        return $this->adapter->describeInstances($names);
    }

    /**
     * Terminate $count instances
     *
     * @param array $names
     * @return mixed
     */
    public function terminateInstances($names)
    {
        return $this->adapter->terminateInstances($names);
    }
}