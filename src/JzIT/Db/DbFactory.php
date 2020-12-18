<?php

namespace JzIT\Db;

use JzIT\Db\EntityManager\EntityManager;
use JzIT\Kernel\AbstractFactory;

/**
 * Class DbFactory
 *
 * @package JzIT\Db
 * @method \JzIT\Db\DbConfig getConfig()
 */
class DbFactory extends AbstractFactory
{
    /**
     * @return \JzIT\Db\EntityManager\EntityManager
     * @throws \JzIT\Kernel\Exception\ConfigNotFoundException
     */
    public function createEntityManager(): EntityManager
    {
        return new EntityManager($this->getConfig());
    }
}