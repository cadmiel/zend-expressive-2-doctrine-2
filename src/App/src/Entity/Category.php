<?php

namespace App\Entity;

use App\Contract\Entity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @Entity
 * @Table(name="categories")
 *
 * */

class Category implements Entity
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
     * @ManyToMany(targetEntity="App\Entity\Post",mappedBy="categories", cascade={"persist","remove"})
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

    public function addPost(Post $post){
        $this->posts->add($post);
        $post->getCategories()->add($this);
        return $this;
    }

    public function getPosts(){
        return $this->posts;
    }



}