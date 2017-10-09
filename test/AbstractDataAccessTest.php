<?php

namespace AppTest;

use App\Doctrine\EntityManager;
use PHPUnit\Framework\TestCase;

abstract class AbstractDataAccessTest extends TestCase
{
    /**
     *
     * @var \PDO
     */
    protected $pdo;

    protected function setUp()
    {
        EntityManager::data()->beginTransaction();
    }

    protected function tearDown()
    {
        EntityManager::data()->rollback();

        /* trucatate all table */
//        $entityManager = EntityManager::data();
//        $metaData = $entityManager->getMetadataFactory()->getAllMetadata();
//        $tool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);
//        $tool->dropSchema($metaData);
//        $tool->createSchema($metaData);
    }
}