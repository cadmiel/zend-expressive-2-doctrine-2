<?php

namespace App\Contract;


use App\Contract\Entity;

interface Repository
{

    public function save(Entity $entity);
    public function remove(int $id);
    public function getById(int $id);
    public function getOneBy($criteria=[]);
    public function getAll();

}