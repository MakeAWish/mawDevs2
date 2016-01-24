<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Wish
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\WishRepository")
 * @ORM\Table("wishes")
 */
class Wish
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="wishes")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", nullable=false, length=100)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", nullable=true, length=255)
     */
    protected $link;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="integer", nullable=false)
     */
    protected $weight;

    public function __construct()
    {
        $this->weight = 0;
    }

    /**
     * @return string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @return string
     */
    public function getWeightLabel()
    {
        $weight = $this->getWeight();
        if ($weight <= 0) {
            return "Pourquoi pas ?";
        } elseif ($weight == 1) {
            echo "J'en ai envie";
        } elseif ($weight == 2) {
            echo "Vitale !";
        }
    }

    /**
     * @param string $weight
     * @return Wish
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Wish
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Wish
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Wish
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return Wish
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param Category $category
     * @return Wish
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }
}