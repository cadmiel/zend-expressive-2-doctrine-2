<?php

declare(strict_types=1);

namespace AppTest\Repository;

use App\Contract\Entity;
use App\Seed\User as UserSeed;
use AppTest\AbstractDataAccessTest;
use App\Repository\User as UserRepository;
use App\Entity\User as UserEntity;
use Mockery as M;

class UserTest extends AbstractDataAccessTest
{

    /**
     * @var \App\Repository\User UserRepository
     */
    private $UserRepository;

    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->UserRepository = new UserRepository();

    }

    public function assertPreConditions()
    {
        parent::assertPreConditions(); // TODO: Change the autogenerated stub
        $this->assertTrue(class_exists(UserEntity::class));
        $this->assertTrue(class_exists(UserRepository::class));
        $this->assertTrue(class_exists(UserSeed::class));
    }

    public function testIfReturnIsUserEntityAndSave()
    {

        $userEntity = $this->saveData();

//        $category = $this->getMockBuilder(UserEntity::class)->getMock();
//        $category->method('save')->willReturn(UserEntity::class);

        $this->assertInstanceOf(UserEntity::class, $userEntity);

        $this->assertAttributeEquals($userEntity->getName(),'name',$userEntity);
        $this->assertTrue(method_exists($userEntity,'getName'));
    }

    public function testIfReturnIsEntityAndSave()
    {
        $this->assertInstanceOf(Entity::class, $this->saveData());
    }

    public function testIfReturnIsEntityAndUpdate()
    {
        $category = new UserEntity();
        $category->setName(UserSeed::$data[3]['name']);
        $category->setEmail(UserSeed::$data[3]['email']);
        $category->setId($this->saveData()->getId());
        $category = $this->UserRepository->save($category);
        $this->assertInstanceOf(Entity::class, $category);
    }

    public function testGetById()
    {
        $category = $this->UserRepository->getById($this->saveData()->getId());
        $this->assertInstanceOf(Entity::class, $category);
        $this->assertInstanceOf(UserEntity::class, $category);
    }

    public function testGetAllIfReturnIsArray()
    {
        $this->saveData();
        $category = $this->UserRepository->getAll();
        $this->assertInternalType('array', $category);
    }

    public function testGetOneByIfReturnIsUserEntity()
    {
        $this->saveData();
        $category = $this->UserRepository->getOneBy();
        $this->assertInstanceOf(UserEntity::class, $category);
    }

    public function testIfReturnIsUserRepository()
    {
        $category = $this->UserRepository->remove($this->saveData()->getId());
        $this->assertInstanceOf(UserRepository::class, $category);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Empty title not allowed
     */
    public function testSetEmailWithInvalidDataShouldThrownAnException()
    {
        $invalidTitle = '';
        $instance = new UserEntity();
        $instance->setEmail($invalidTitle);
    }

    public function testClassMockey()
    {
        $instance = M::mock(\stdClass::class);
        $instance->shouldReceive('getAll')->with(['name'=>''],1)->andReturn([]);
        $instance->name = 'nome completo';

        $this->assertInstanceOf(\stdClass::class,$instance);
        $this->assertAttributeEquals($instance->name,'name',$instance);
        $this->assertInternalType('array',$instance->getAll(['name'=>''],1));
    }

    private function saveData()
    {
        $userEntity = new UserEntity();
        $userEntity->setName(UserSeed::$data[1]['name']);
        $userEntity->setEmail(UserSeed::$data[1]['email']);
        return $this->UserRepository->save($userEntity);
    }

}