<?php

namespace Dart\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    private $file;

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
    /**
     * @var string
     */
    private $image;


    /**
     * Set image
     *
     * @param string $image
     *
     * @return Meal
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }
    
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
    }
    
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * Upload image
     */
    public function imageUpload()
    {
        if (null === $this->file) {
            return;
        }
        
        $file = $this->getFile();
        $filename = sha1(uniqid(mt_rand(), true)) . '.' . $file->guessExtension();
        
        $file->move($this->getSourceUploadDir(), $filename);
        
        $this->setImage($filename);
    }
    
    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../web/';
    }
    
    protected function getUploadDir()
    {
        return $this->getUploadRootDir() . 'uploads/images';
    }
    
    protected function getThumbnailUploadDir()
    {
        return $this->getUploadDir() . '/thumbs';
    }
    
    protected function getSourceUploadDir()
    {
        return $this->getUploadDir() . '/sources';
    }
    /**
     * @var integer
     */
    private $category_id;

    /**
     * @var \Dart\AppBundle\Entity\Category
     */
    private $category;


    /**
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Meal
     */
    public function setCategoryId($categoryId)
    {
        $this->category_id = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set category
     *
     * @param \Dart\AppBundle\Entity\Category $category
     *
     * @return Meal
     */
    public function setCategory(\Dart\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Dart\AppBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
