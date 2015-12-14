<?php

namespace Dart\AppBundle\Entity;

/**
 * OrderItem
 */
class OrderItem
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $order_id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $price;

    /**
     * @var \Dart\AppBundle\Entity\Order
     */
    private $order;

    private $image;

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
     * Set orderId
     *
     * @param integer $orderId
     *
     * @return OrderItem
     */
    public function setOrderId($orderId)
    {
        $this->order_id = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return OrderItem
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
     * Set price
     *
     * @param integer $price
     *
     * @return OrderItem
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
     * Set order
     *
     * @param \Dart\AppBundle\Entity\Order $order
     *
     * @return OrderItem
     */
    public function setOrder(\Dart\AppBundle\Entity\Order $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Dart\AppBundle\Entity\Order
     */
    public function getOrder()
    {
        return $this->order;
    }
    /**
     * @var integer
     */
    private $count;


    /**
     * Set count
     *
     * @param integer $count
     *
     * @return OrderItem
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer
     */
    public function getCount()
    {
        return $this->count;
    }
    /**
     * @var integer
     */
    private $product_id;

    /**
     * @var \Dart\AppBundle\Entity\Meal
     */
    private $product;


    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return OrderItem
     */
    public function setProductId($productId)
    {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set product
     *
     * @param \Dart\AppBundle\Entity\Meal $product
     *
     * @return OrderItem
     */
    public function setProduct(\Dart\AppBundle\Entity\Meal $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Dart\AppBundle\Entity\Meal
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    /**
     * Virtual field image setter
     * 
     * @param type $image
     * @return \Dart\AppBundle\Entity\OrderItem
     */
    public function setImage($image)
    {
        $this->image = $image;
        
        return $this;
    }
    
    /**
     * Virtual field image getter
     * 
     * @return type
     */
    public function getImage()
    {
        return $this->image;
    }
}
