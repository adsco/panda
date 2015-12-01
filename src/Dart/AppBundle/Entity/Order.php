<?php

namespace Dart\AppBundle\Entity;

/**
 * Order
 */
class Order
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $profile_id;

    /**
     * @var integer
     */
    private $delivery_address_id;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var integer
     */
    private $delivery_price;

    /**
     * @var integer
     */
    private $change;

    /**
     * @var \DateTime
     */
    private $creation_date;

    /**
     * @var \Dart\AppBundle\Entity\DeliveryAddress
     */
    private $delivery_address;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $order_items;

    /**
     * @var \Dart\AppBundle\Entity\UserProfile
     */
    private $profile;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->order_items = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set profileId
     *
     * @param integer $profileId
     *
     * @return Order
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

    /**
     * Set deliveryAddressId
     *
     * @param integer $deliveryAddressId
     *
     * @return Order
     */
    public function setDeliveryAddressId($deliveryAddressId)
    {
        $this->delivery_address_id = $deliveryAddressId;

        return $this;
    }

    /**
     * Get deliveryAddressId
     *
     * @return integer
     */
    public function getDeliveryAddressId()
    {
        return $this->delivery_address_id;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Order
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
     * Set deliveryPrice
     *
     * @param integer $deliveryPrice
     *
     * @return Order
     */
    public function setDeliveryPrice($deliveryPrice)
    {
        $this->delivery_price = $deliveryPrice;

        return $this;
    }

    /**
     * Get deliveryPrice
     *
     * @return integer
     */
    public function getDeliveryPrice()
    {
        return $this->delivery_price;
    }

    /**
     * Set change
     *
     * @param integer $change
     *
     * @return Order
     */
    public function setChange($change)
    {
        $this->change = $change;

        return $this;
    }

    /**
     * Get change
     *
     * @return integer
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Order
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
     * Set deliveryAddress
     *
     * @param \Dart\AppBundle\Entity\DeliveryAddress $deliveryAddress
     *
     * @return Order
     */
    public function setDeliveryAddress(\Dart\AppBundle\Entity\DeliveryAddress $deliveryAddress = null)
    {
        $this->delivery_address = $deliveryAddress;

        return $this;
    }

    /**
     * Get deliveryAddress
     *
     * @return \Dart\AppBundle\Entity\DeliveryAddress
     */
    public function getDeliveryAddress()
    {
        return $this->delivery_address;
    }

    /**
     * Add orderItem
     *
     * @param \Dart\AppBundle\Entity\OrderItem $orderItem
     *
     * @return Order
     */
    public function addOrderItem(\Dart\AppBundle\Entity\OrderItem $orderItem)
    {
        $this->order_items[] = $orderItem;

        return $this;
    }

    /**
     * Remove orderItem
     *
     * @param \Dart\AppBundle\Entity\OrderItem $orderItem
     */
    public function removeOrderItem(\Dart\AppBundle\Entity\OrderItem $orderItem)
    {
        $this->order_items->removeElement($orderItem);
    }

    /**
     * Get orderItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderItems()
    {
        return $this->order_items;
    }

    /**
     * Set profile
     *
     * @param \Dart\AppBundle\Entity\UserProfile $profile
     *
     * @return Order
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
    /**
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        $this->setCreationDate(new \DateTime());
    }
}
