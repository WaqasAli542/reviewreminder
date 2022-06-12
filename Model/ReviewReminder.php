<?php

namespace WMZ\ReviewReminder\Model;

use Magento\Framework\Model\AbstractModel;
use WMZ\ReviewReminder\Api\Data\ReviewReminderInterface;

class ReviewReminder extends AbstractModel implements ReviewReminderInterface
{
    /**
     * Resource Model
     */
    public function _construct()
    {
        $this->_init(ResourceModel\ReviewReminder::class);
    }

    /**
     * @return int|null
     */
    public function getReminderId(): ?int
    {
        return $this->getData(ReviewReminderInterface::REMINDER_ID);
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->getData(ReviewReminderInterface::STATUS);
    }

    /**
     * @return int|null
     */
    public function getOrderId(): ?int
    {
        return $this->getData(ReviewReminderInterface::ORDER_ID);
    }

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string
    {
        return $this->getData(ReviewReminderInterface::CUSTOMER_EMAIL);
    }

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->getData(ReviewReminderInterface::CUSTOMER_NAME);
    }

    /**
     * @return int|null
     */
    public function getStoreID(): ?int
    {
        return $this->getData(ReviewReminderInterface::STORE_ID);
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(ReviewReminderInterface::CREATED_AT);
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(ReviewReminderInterface::UPDATED_AT);
    }

    /**
     * @param $reminderId
     */
    public function setReminderId($reminderId)
    {
        $this->setData(ReviewReminderInterface::REMINDER_ID, $reminderId);
    }

    /**
     * @param $status
     */
    public function setStatus($status)
    {
        $this->setData(ReviewReminderInterface::STATUS, $status);
    }

    /**
     * @param $orderId
     */
    public function setOrderId($orderId)
    {
        $this->setData(ReviewReminderInterface::ORDER_ID, $orderId);
    }

    /**
     * @param $customerEmail
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->setData(ReviewReminderInterface::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * @param $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->setData(ReviewReminderInterface::CUSTOMER_NAME, $customerName);
    }

    /**
     * @param $storeId
     */
    public function setStoreID($storeId)
    {
        $this->setData(ReviewReminderInterface::STORE_ID, $storeId);
    }

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData(ReviewReminderInterface::CREATED_AT, $createdAt);
    }

    /**
     * @param $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->setData(ReviewReminderInterface::UPDATED_AT, $updatedAt);
    }
}
