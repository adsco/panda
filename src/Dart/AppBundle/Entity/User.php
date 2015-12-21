<?php

namespace Dart\AppBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;


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
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \DateTime
     */
    private $modification_date;
    
    /**
     * Contructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
        //default user role
        $this->addRole('ROLE_USER');
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return User
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
     * @return User
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $orders;


    /**
     * Add order
     *
     * @param \Dart\AppBundle\Entity\Order $order
     *
     * @return User
     */
    public function addOrder(\Dart\AppBundle\Entity\Order $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Dart\AppBundle\Entity\Order $order
     */
    public function removeOrder(\Dart\AppBundle\Entity\Order $order)
    {
        $this->orders->removeElement($order);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
    /**
     * @var \Dart\AppBundle\Entity\UserProfile
     */
    private $profile;


    /**
     * Set profile
     *
     * @param \Dart\AppBundle\Entity\UserProfile $profile
     *
     * @return User
     */
    public function setProfile(\Dart\AppBundle\Entity\UserProfile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \Dart\AppBundle\Entity\UserProfile
     */
    public function getProfile()
    {
        return $this->profile;
    }
    
    public function prePersist()
    {
        $this->setCreationDate(new \DateTime());
        $this->setModificationDate(new \DateTime());
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $addresses;


    /**
     * Add address
     *
     * @param \Dart\AppBundle\Entity\UserAddress $address
     *
     * @return User
     */
    public function addAddress(\Dart\AppBundle\Entity\UserAddress $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Dart\AppBundle\Entity\UserAddress $address
     */
    public function removeAddress(\Dart\AppBundle\Entity\UserAddress $address)
    {
        $this->addresses->removeElement($address);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
    /**
     * @var integer
     */
    private $profile_id;


    /**
     * Set profileId
     *
     * @param integer $profileId
     *
     * @return User
     */
    public function setProfileId($profileId)
    {
        $this->profile_id = $profileId;

        return $this;
    }

    /**
     * Get profileId
     *
     * @return integer
     */
    public function getProfileId()
    {
        return $this->profile_id;
    }
}
