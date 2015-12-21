<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Dart\AppBundle\Entity\UserProfile;
use Dart\AppBundle\Entity\UserAddress;

/**
 * This file has been generated by the Sonata EasyExtends bundle.
 *
 * @link https://sonata-project.org/bundles/easy-extends
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class User extends BaseUser
{
    /**
     * @var int $id
     */
    protected $id;

    /**
     * Get id
     *
     * @return int $id
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

    public function __construct()
    {
        parent::__construct();
        
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
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
     * Pre persist action
     */
    public function prePersist()
    {
        $this->setCreationDate(new \DateTime());
        $this->setModificationDate(new \DateTime());
    }
    
    /**
     * @var \Application\Sonata\UserBundle\Entity\UserProfile
     */
    private $profile;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $addresses;


    /**
     * Set profile
     *
     * @param \Dart\AppBundle\Entity\UserProfile $profile
     *
     * @return User
     */
    public function setProfile(UserProfile $profile = null)
    {
        $this->profile = $profile;
        
        if (null !== $profile) {
            $profile->setUser($this);
        }

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

    /**
     * Add address
     *
     * @param \Dart\AppBundle\Entity\UserAddress $address
     *
     * @return User
     */
    public function addAddress(UserAddress $address)
    {
        $this->addresses[] = $address;

        return $this;
    }

    /**
     * Remove address
     *
     * @param \Dart\AppBundle\Entity\UserAddress $address
     */
    public function removeAddress(UserAddress $address)
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
}
