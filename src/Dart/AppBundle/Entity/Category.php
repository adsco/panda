<?php

namespace Dart\AppBundle\Entity;

/**
 * Category
 */
class Category
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $cuisine_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \DateTime
     */
    private $update_date;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $meals;

    /**
     * @var \Dart\AppBundle\Entity\Cuisine
     */
    private $cuisine;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->meals = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set cuisineId
     *
     * @param integer $cuisineId
     *
     * @return Category
     */
    public function setCuisineId($cuisineId)
    {
        $this->cuisine_id = $cuisineId;

        return $this;
    }

    /**
     * Get cuisineId
     *
     * @return integer
     */
    public function getCuisineId()
    {
        return $this->cuisine_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Category
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Category
     */
    public function setUpdateDate($updateDate)
    {
        $this->update_date = $updateDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * Add meal
     *
     * @param \Dart\AppBundle\Entity\Meal $meal
     *
     * @return Category
     */
    public function addMeal(\Dart\AppBundle\Entity\Meal $meal)
    {
        $this->meals[] = $meal;

        return $this;
    }

    /**
     * Remove meal
     *
     * @param \Dart\AppBundle\Entity\Meal $meal
     */
    public function removeMeal(\Dart\AppBundle\Entity\Meal $meal)
    {
        $this->meals->removeElement($meal);
    }

    /**
     * Get meals
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeals()
    {
        return $this->meals;
    }

    /**
     * Set cuisine
     *
     * @param \Dart\AppBundle\Entity\Cuisine $cuisine
     *
     * @return Category
     */
    public function setCuisine(\Dart\AppBundle\Entity\Cuisine $cuisine = null)
    {
        $this->cuisine = $cuisine;

        return $this;
    }

    /**
     * Get cuisine
     *
     * @return \Dart\AppBundle\Entity\Cuisine
     */
    public function getCuisine()
    {
        return $this->cuisine;
    }
}

