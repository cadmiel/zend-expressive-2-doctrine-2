<?php

namespace App\Repository;

use App\Contract\Entity;
use App\Entity\User as UserEntity;
use App\Contract\Repository;

class User extends AbstractEntityManager implements Repository
{

    private $entityManagerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->entityManagerRepository = $this->entityManager->getRepository(UserEntity::class);
    }

    public function save(Entity $UserEntity) : UserEntity
    {

        if($UserEntity->getId() >= 1)
        {
            /* @var \App\Entity\User $entity */
            $entity = $this->entityManagerRepository->find($UserEntity->getId());
            $entity->setName($UserEntity->getName());
            $entity->setEmail($UserEntity->getEmail());
        }else{
            $this->entityManager->persist($UserEntity);
        }
        $this->entityManager->flush();

        return $UserEntity;
    }

    public function remove(int $id) : self
    {
        $this->entityManager->remove($this->getById($id));
        $this->entityManager->flush();
        return $this;
    }

    public function getById(int $id) : UserEntity
    {
        return $this->entityManagerRepository->find($id);
    }

    public function getAll() : array
    {
        return $this->entityManagerRepository->findAll();
    }

    public function getOneBy($criteria=[]) : UserEntity
    {
        return $this->entityManagerRepository->findOneBy($criteria);
    }

}