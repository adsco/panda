<?php

namespace Dart\AppBundle\Entity;

/**
 * Meal
 */
class Meal
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var integer
     */
    private $weight;

    /**
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \DateTime
     */
    private $modification_date;


    /**
     * Get id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Meal
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
     * Set description
     *
     * @param string $description
     *
     * @return Meal
     */
    public function setDescription($description)
    {
        $this->description = $description;

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
     * Set price
     *
     * @param integer $price
     *
     * @return Meal
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return Meal
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set creationDate
     *
     * @return Meal
     */
    public function setCreationDate()
    {
        $this->creation_date = new \DateTime();

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
     * Set modificationDate
     *
     * @return Meal
     */
    public function setModificationDate()
    {
        $this->modification_date = new \DateTime();

        return $this;
    }

    /**
     * Get modificationDate
     *
     * @return \DateTime
     */
    public function getModificationDate()
    {
        return $this->modification_date;
    }
    /**
     * @var integer
     */
    private $cuisine_id;

    /**
     * @var \Dart\AppBundle\Entity\Cuisine
     */
    private $cuisine;


    /**
     * Set cuisineId
     *
     * @param integer $cuisineId
     *
     * @return Meal
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
     * Set cuisine
     *
     * @param \Dart\AppBundle\Entity\Cuisine $cuisine
     *
     * @return Meal
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
