<?php

namespace Dart\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserAddress
 */
class UserAddress
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $user_id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $building;

    /**
     * @var integer
     */
    private $porch;

    /**
     * @var string
     */
    private $apartment;

    /**
     * @var string
     */
    private $intercome_code;

    /**
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \DateTime
     */
    private $modification_date;

    /**
     * @var \Dart\AppBundle\Entity\User
     */
    private $user;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserAddress
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return UserAddress
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
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
     * Set street
     *
     * @param string $street
     *
     * @return UserAddress
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set building
     *
     * @param string $building
     *
     * @return UserAddress
     */
    public function setBuilding($building)
    {
        $this->building = $building;

        return $this;
    }

    /**
     * Get building
     *
     * @return string
     */
    public function getBuilding()
    {
        return $this->building;
    }

    /**
     * Set porch
     *
     * @param integer $porch
     *
     * @return UserAddress
     */
    public function setPorch($porch)
    {
        $this->porch = $porch;

        return $this;
    }

    /**
     * Get porch
     *
     * @return integer
     */
    public function getPorch()
    {
        return $this->porch;
    }

    /**
     * Set apartment
     *
     * @param string $apartment
     *
     * @return UserAddress
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;

        return $this;
    }

    /**
     * Get apartment
     *
     * @return string
     */
    public function getApartment()
    {
        return $this->apartment;
    }

    /**
     * Set intercomeCode
     *
     * @param string $intercomeCode
     *
     * @return UserAddress
     */
    public function setIntercomeCode($intercomeCode)
    {
        $this->intercome_code = $intercomeCode;

        return $this;
    }

    /**
     * Get intercomeCode
     *
     * @return string
     */
    public function getIntercomeCode()
    {
        return $this->intercome_code;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return UserAddress
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
     * Set modificationDate
     *
     * @param \DateTime $modificationDate
     *
     * @return UserAddress
     */
    public function setModificationDate($modificationDate)
    {
        $this->modification_date = $modificationDate;

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
     * Set user
     *
     * @param \Dart\AppBundle\Entity\User $user
     *
     * @return UserAddress
     */
    public function setUser(\Dart\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Dart\AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreationDate(new \DateTime());
        $this->preUpdate();
    }

    /**
     * @ORM\PreUpdate
     */
    public function preUpdate()
    {
        $this->setModificationDate(new \DateTime());
    }
    /**
     * @var string
     */
    private $note;


    /**
     * Set note
     *
     * @param string $note
     *
     * @return UserAddress
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }
}
