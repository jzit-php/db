<?php


namespace JzIT\Db;


use Doctrine\Common\Cache\Cache;
use JzIT\Kernel\AbstractConfig;
use JzIT\Kernel\KernelConstants;

class DbConfig extends AbstractConfig
{
    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->get(DbConstants::DB_HOST, '');
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->get(DbConstants::DB_USER, '');
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->get(DbConstants::DB_PASSWORD, '');
    }

    /**
     * @return string
     */
    public function getDatabase(): string
    {
        return $this->get(DbConstants::DB_DATABASE_NAME, '');
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->get(DbConstants::DB_PORT, '');
    }

    /**
     * @return bool
     */
    public function isDevMode(): bool
    {
        return $this->get(KernelConstants::IS_DEV_MODE, false);
    }

    /**
     * @return bool
     */
    public function useSimpleAnnotationReader(): bool
    {
        return $this->get(DbConstants::DB_USE_SIMPLE_ANNOTATION_READER, false);
    }

    /**
     * @return string|null
     */
    public function getProxyDir(): ?string
    {
        try {
            $this->get(DbConstants::DB_PROXY_DIR);
        }
        catch (\Exception $exception){
            return null;
        }
    }

    /**
     * @return \Doctrine\Common\Cache\Cache|null
     */
    public function getCache(): ?Cache
    {
        try {
            $this->get(DbConstants::DB_CACHE);
        }
        catch (\Exception $exception){
            return null;
        }
    }
}