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
     * @param array $ids
     * @return mixed
     */
    public function describeInstances(array $ids)
    {
        return $this->adapter->describeInstances($ids);
    }

    /**
     * Terminate $count instances
     *
     * @param array $ids
     * @return mixed
     */
    public function terminateInstances(array $ids)
    {
        return $this->adapter->terminateInstances($ids);
    }
}
