<?php

namespace WMZ\ReviewReminder\Api;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use WMZ\ReviewReminder\Api\Data\ReviewReminderInterface;

interface ReviewReminderRepositoryInterface
{
    /**
     * @param ReviewReminderInterface $reminder
     * @return ReviewReminderInterface
     * @throws CouldNotSaveException
     */
    public function save(ReviewReminderInterface $reminder);

    /**
     * @param $id
     * @return ReviewReminderInterface
     * @throws NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param $orderId
     * @return ReviewReminderInterface
     * @throws NoSuchEntityException
     */
    public function getByOrderId($orderId);

    /**
     * @param ReviewReminderInterface $reminder
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(ReviewReminderInterface $reminder);

    /**
     * @param $id
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function deleteById($id);

    /**
     *  getList
     *
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return SearchResultsInterface
     * @throws NoSuchEntityException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
