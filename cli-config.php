<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
//require_once __DIR__.'/src/Doctrine/EntityManager.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = \App\Doctrine\EntityManager::data();

return ConsoleRunner::createHelperSet($entityManager);