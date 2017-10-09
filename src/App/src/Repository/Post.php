<?php

namespace App\Repository;

use App\Contract\Entity;
use App\Entity\Post as PostEntity;
use App\Contract\Repository;

class Post extends AbstractEntityManager implements Repository
{

    private $entityManagerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->entityManagerRepository = $this->entityManager->getRepository(PostEntity::class);
    }

    public function save(Entity $postEntity) : PostEntity
    {

        if($postEntity->getId() >= 1)
        {
            /* @var \App\Entity\Post $entity */
            $entity = $this->entityManagerRepository->find($postEntity->getId());
            $entity->setContext($postEntity->getContext());
            $entity->setTitle($postEntity->getTitle());
        }else{
            $this->entityManager->persist($postEntity);
        }
        $this->entityManager->flush();

        return $postEntity;
    }

    public function remove(int $id) : self
    {
        $this->entityManager->remove($this->getById($id));
        $this->entityManager->flush();
        return $this;
    }

    public function getById(int $id) : PostEntity
    {
        return $this->entityManagerRepository->find($id);
    }

    public function getAll() : array
    {
        return $this->entityManagerRepository->findAll();
    }

    public function getOneBy($criteria=[]) : PostEntity
    {
        return $this->entityManagerRepository->findOneBy($criteria);
    }

}