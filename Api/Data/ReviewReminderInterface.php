<?php

namespace WMZ\ReviewReminder\Api\Data;

interface ReviewReminderInterface
{
    const REMINDER_ID = "reminder_id";
    const STATUS = "status";
    const ORDER_ID = "order_id";
    const CUSTOMER_EMAIL = "customer_email";
    const CUSTOMER_NAME = "customer_name";
    const STORE_ID = "store_id";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    /**
     * @return int|null
     */
    public function getReminderId(): ?int;

    /**
     * @return boolean
     */
    public function getStatus(): bool;

    /**
     * @return int
     */
    public function getOrderId(): ?int;

    /**
     * @return string|null
     */
    public function getCustomerEmail(): ?string;

    /**
     * @return string|null
     */
    public function getCustomerName(): ?string;

    /**
     * @return int|null
     */
    public function getStoreID(): ?int;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param $reminderId
     */
    public function setReminderId($reminderId);

    /**
     * @param $status
     */
    public function setStatus($status);

    /**
     * @param $orderId
     */
    public function setOrderId($orderId);

    /**
     * @param $customerEmail
     */
    public function setCustomerEmail($customerEmail);

    /**
     * @param $customerName
     */
    public function setCustomerName($customerName);

    /**
     * @param $storeId
     */
    public function setStoreID($storeId);

    /**
     * @param $createdAt
     */
    public function setCreatedAt($createdAt);

    /**
     * @param $updatedAt
     */
    public function setUpdatedAt($updatedAt);
}
