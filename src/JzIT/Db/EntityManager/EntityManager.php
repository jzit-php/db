<?php

namespace JzIT\Db\EntityManager;

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
     * @var bool
     */
    protected $useSimpleAnnotationReader;

    public function __construct(DbConfig $config)
    {
        $this->config = $config;
        $this->init();
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(): DoctrineEntityManager
    {
        return DoctrineEntityManager::create($this->getConnection(), $this->createConfig());
    }

    /**
     * @return void
     */
    protected function init(): void
    {
        $this->isDevMode = $this->config->isDevMode();
        $this->proxyDir = $this->config->getProxyDir();
        $this->cache = $this->config->getCache();
        $this->useSimpleAnnotationReader = $this->config->useSimpleAnnotationReader();
    }

    /**
     * @return \Doctrine\ORM\Configuration
     */
    protected function createConfig(): Configuration
    {
        return Setup::createAnnotationMetadataConfiguration([__DIR__ . "/src"], $this->isDevMode, $this->proxyDir, $this->cache, $this->useSimpleAnnotationReader);
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