<?php

namespace Dart\AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
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
}
