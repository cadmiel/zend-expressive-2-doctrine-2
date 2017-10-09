<?php

namespace App\Entity;

use App\Contract\Entity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="posts")
 *
 */

class Post implements Entity
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
    private $title;

    /**
     * @Name
     * @Column(type="text")
     * */
    private $context;

    /**
     * @ManyToMany(targetEntity="App\Entity\Category", inversedBy="posts", cascade={"persist","remove"})
     *
     */
    private $categories;


    /**
     * @ManyToOne(targetEntity="App\Entity\User", inversedBy="posts")
     */
    private $user;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     * @return Post
     */
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
    }

    public function addCategory(Category $category)
    {
        $this->categories->add($category);
        $category->getPosts()->add($this);
        return $this;
    }


    /**
     * @return ArrayCollection
     */
    public function getCategory()
    {
        return $this->categories;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;

    }


//$queryBuilder = $postsRepository->createQueryBuilder('p');
//$queryBuilder->join('p.categories', 'c')
//->where($queryBuilder->expr()->eq('c.id', $data['search']));
//$posts = $queryBuilder->getQuery()->getResult();



}