<?php

namespace JzIT\Db\EntityManager;

use Doctrine\DBAL\Driver\Connection;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\Tools\Setup;
use JzIT\Db\DbConfig;
use Doctrine\ORM\EntityManager as DoctrineEntityManager;

class EntityManager
{
    /**
     * @var \JzIT\Db\DbConfig
     */
    protected $config;

    /**
     * @var bool
     */
    protected $isDevMode;

    /**
     * @var null|string
     */
    protected $proxyDir;

    /**
     * @var null|\Doctrine\Common\Cache\Cache
     */
    protected $cache;

    /**
     * @var string
     */
    protected $workingDir;

    /**
     * @var \Doctrine\DBAL\Driver\Connection|null
     */
    protected $connection;

    /**
     * @var bool
     */
    protected $useSimpleAnnotationReader;

    /**
     * EntityManager constructor.
     *
     * @param \JzIT\Db\DbConfig $config
     * @param \Doctrine\DBAL\Driver\Connection|null $connection
     */
    public function __construct(DbConfig $config, Connection $connection = null)
    {
        $this->connection = $connection;
        $this->config = $config;
        $this->init();
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(): DoctrineEntityManager
    {
        $connection = $this->connection;
        if ($connection === null) {
            $connection = $this->getConnection();
        }
        return DoctrineEntityManager::create($connection, $this->createConfig());
    }

    /**
     * @return void
     */
    protected function init(): void
    {
        $this->isDevMode = $this->config->isDevMode();
        $this->proxyDir = $this->config->getProxyDir();
        $this->cache = $this->config->getCache();
        $this->workingDir = $this->config->getWorkingDir();
        $this->useSimpleAnnotationReader = $this->config->useSimpleAnnotationReader();
    }

    /**
     * @return \Doctrine\ORM\Configuration
     */
    protected function createConfig(): Configuration
    {
        return Setup::createAnnotationMetadataConfiguration([$this->workingDir], $this->isDevMode, $this->proxyDir, $this->cache, $this->useSimpleAnnotationReader);
    }

    /**
     * @return array|string[]
     */
    protected function getConnection(): array
    {
        return [
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/db.sqlite',
        ];
    }
}
