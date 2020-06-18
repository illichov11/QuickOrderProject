<?php


namespace Alevel\Project\Model\Data;

use Alevel\Project\Api\Data\QuickOrderInterface;

/**
 * Class QuickOrder
 *
 * @package Alevel\Project\Model\Data
 */
class QuickOrder extends \Magento\Framework\Api\AbstractExtensibleObject implements QuickOrderInterface
{

    /**
     * Get order_id
     * @return string|null
     */
    public function getOrderId()
    {
        return $this->_get(self::ORDER_ID);
    }

    /**
     * Set order_id
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        return $this->setData(self::ORDER_ID, $orderId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }


    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }


    public function setExtensionAttributes(
        \Alevel\Project\Api\Data\QuickOrderExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get sku
     * @return string|null
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * Set sku
     * @param string $sku
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Get phone
     * @return string|null
     */
    public function getPhone()
    {
        return $this->_get(self::PHONE);
    }

    /**
     * Set phone
     * @param string $phone
     */
    public function setPhone($phone)
    {
        return $this->setData(self::PHONE, $phone);
    }

    /**
     * Get email
     * @return string|null
     */
    public function getEmail()
    {
        return $this->_get(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get status
     * @return string|null
     */
    public function getStatus()
    {
        return $this->_get(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * @return string|null
     */
    public function getCreateAt()
    {
        return $this->_get(self::CREATE_AT);
    }

    /**
     * @param string $createAt
     */
    public function setCreateTime($createAt)
    {
        return $this->setData(self::CREATE_AT, $createAt);
    }

    /**
     * @return string|null
     */
    public function getUpdateAt()
    {
        return $this->_get(self::UPDATE_AT);
    }

    /**
     * Set UpdateTime
     * @param string $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        return $this->setData(self::UPDATE_AT, $updateAt);
    }
}

