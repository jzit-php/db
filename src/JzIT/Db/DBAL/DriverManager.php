<?php

namespace JzIT\Db\DBAL;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager as DoctrineDriverManager;
use JzIT\Db\DbConfig;

class DriverManager implements DriverManagerInterface
{
    public function __construct(DbConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection(): Connection
    {
        return DoctrineDriverManager::getConnection($this->getConnectionParams());
    }

    /**
     * @return array|string[]
     */
    protected function getConnectionParams(): array
    {
        return [
            'dbname' => $this->config->getDatabase(),
            'user' => $this->config->getUser(),
            'password' => $this->config->getPassword(),
            'host' => $this->config->getHost(),
            'driver' => 'pdo_mysql',
        ];
    }
}
