<?php

namespace JzIT\Db\DBAL;

use Doctrine\DBAL\Connection;

interface DriverManagerInterface
{
    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection(): Connection;
}
