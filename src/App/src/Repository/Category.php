<?php

namespace App\Repository;

use App\Contract\Entity;
use App\Entity\Category as CategoryEntity;
use App\Contract\Repository;
use App\Doctrine\EntityManager;

class Category extends AbstractEntityManager implements Repository
{

    private $entityManagerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->entityManagerRepository = $this->entityManager->getRepository(CategoryEntity::class);
    }

    public function save(Entity $categoryEntity) : CategoryEntity
    {

        if($categoryEntity->getId() >= 1)
        {
            /* @var \App\Entity\Category $entity */
            $entity = $this->entityManagerRepository->find($categoryEntity->getId());
            $entity->setName($categoryEntity->getName());
        }else{
            $this->entityManager->persist($categoryEntity);
        }
        $this->entityManager->flush();

        return $categoryEntity;
    }

    public function remove(int $id) : self
    {
        $this->entityManager->remove($this->getById($id));
        $this->entityManager->flush();
        return $this;
    }

    public function getById(int $id) : CategoryEntity
    {
        return $this->entityManagerRepository->find($id);
    }

    public function getAll() : array
    {
        return $this->entityManagerRepository->findAll();
    }

    public function getOneBy($criteria=[]) : CategoryEntity
    {
        return $this->entityManagerRepository->findOneBy($criteria);
    }

}