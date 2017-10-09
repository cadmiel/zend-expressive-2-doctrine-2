<?php

namespace App\Doctrine;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager as EntityManagerDoctrine;

class EntityManager
{
    static $data = null;

    private static function getEntityManager()
    {
        $path = [
            __DIR__.'/../Entity'
        ];

        $isDevMode = true;

        $dbParams = [
            'driver'     =>  'pdo_mysql',
            'user'       =>  'dbadmin',
            'password'   =>  'adminpw',
            'dbname'     =>  'doctrine',
            'host'       =>  'mysql',
        ];

        $config = Setup::createAnnotationMetadataConfiguration($path, $isDevMode);

        $entityManager = EntityManagerDoctrine::create($dbParams,$config);
        return $entityManager;
    }

    static function data()
    {
        if(is_null(self::$data))
            self::$data = self::getEntityManager();
        return self::$data;
    }
}


