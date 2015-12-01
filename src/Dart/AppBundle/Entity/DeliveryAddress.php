<?php

namespace Dart\AppBundle\Entity;

/**
 * DeliveryAddress
 */
class DeliveryAddress
{
    /**
     * @var integer
     */
    private $id;

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
     * @var integer
     */
    private $apartment;

    /**
     * @var string
     */
    private $intercome_code;

    /**
     * @var string
     */
    private $note;

    /**
     * @var \Dart\AppBundle\Entity\Order
     */
    private $order;


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
     * Set street
     *
     * @param string $street
     *
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @return DeliveryAddress
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
     * @param integer $apartment
     *
     * @return DeliveryAddress
     */
    public function setApartment($apartment)
    {
        $this->apartment = $apartment;

        return $this;
    }

    /**
     * Get apartment
     *
     * @return integer
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
     * @return DeliveryAddress
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
     * Set note
     *
     * @param string $note
     *
     * @return DeliveryAddress
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

    /**
     * Set order
     *
     * @param \Dart\AppBundle\Entity\Order $order
     *
     * @return DeliveryAddress
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
}
