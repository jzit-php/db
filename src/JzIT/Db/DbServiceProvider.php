<?php

declare(strict_types=1);

namespace JzIT\Db;

use Di\Container;
use JzIT\Container\ServiceProvider\AbstractServiceProvider;
use JzIT\Db\DBAL\DriverManager;

/**
 * @method  \JzIT\Db\DbFactory getFactory()
 * @method  \JzIT\Db\DbConfig getConfig()
 */
class DbServiceProvider extends AbstractServiceProvider
{
    /**
     * @param \Di\Container $container
     */
    public function register(Container $container): void
    {
        $this->registerEntityManager($container);
    }

    /**
     * @param \Di\Container $container
     * @return \JzIT\Db\DbServiceProvider
     */
    protected function registerEntityManager(Container $container): DbServiceProvider
    {
        $em = $this->getFactory()->createEntityManager();
        $container->set('entityManager', function () use ($em) {
            return $em->create();
        });

        return $this;
    }
}
