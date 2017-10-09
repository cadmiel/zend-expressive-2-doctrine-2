<?php

namespace App\Entity;

use App\Contract\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use \InvalidArgumentException as Argument;

/**
 * @Entity
 * @Table(name="users")
 *
 * */

class User implements Entity
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue(strategy="AUTO")
     * */
    private $id;


    /**
     * @Name
     * @Column(type="string", length=50)
     * */
    private $name;

    /**
     * @Email
     * @Column(type="string", length=50, unique=true)
     * */
    private $email;


    /**
     * @OneToMany(targetEntity="App\Entity\Post",cascade={"persist"}, mappedBy="user")
     */
    private $posts;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return User
     */
    public function setEmail($email)
    {
        if (empty($email)) {
            throw new Argument('Empty title not allowed');
        }
        $this->email = $email;
        return $this;
    }

    public function addPost(Post $post){
        //$this->posts[] = $post;
        $this->posts->add($post);
        $post->setUser($this);
        return $this;
    }
    public function getPosts(){
        return $this->posts;
    }

}