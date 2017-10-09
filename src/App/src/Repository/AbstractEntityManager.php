<?php

namespace App\Repository;

use App\Doctrine\EntityManager;

abstract class AbstractEntityManager
{
    protected $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManager::data();
    }

}