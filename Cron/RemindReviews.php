<?php

namespace WMZ\ReviewReminder\Cron;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\NoSuchEntityException;
use WMZ\ReviewReminder\Api\ReviewReminderRepositoryInterface;
use WMZ\ReviewReminder\Helper\Data;
use WMZ\ReviewReminder\Model\Config\Source\Status;
use WMZ\ReviewReminder\Model\Reminder\EmailSender;
use WMZ\ReviewReminder\Model\ResourceModel\ReviewReminder\Collection;
use WMZ\ReviewReminder\Model\ResourceModel\ReviewReminder\CollectionFactory;

class RemindReviews
{
    /**
     * @var Data
     */
    private $helperData;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var EmailSender
     */
    private $emailSender;

    /**
     * @var ReviewReminderRepositoryInterface
     */
    private $reviewReminderRepositoryInterface;

    /**
     * RemindReviews constructor.
     * @param Data $helperData
     * @param CollectionFactory $collectionFactory
     * @param EmailSender $emailSender
     * @param ReviewReminderRepositoryInterface $reviewReminderRepositoryInterface
     */
    public function __construct(
        Data $helperData,
        CollectionFactory $collectionFactory,
        EmailSender $emailSender,
        ReviewReminderRepositoryInterface $reviewReminderRepositoryInterface
    ) {
        $this->helperData = $helperData;
        $this->collectionFactory = $collectionFactory;
        $this->emailSender = $emailSender;
        $this->reviewReminderRepositoryInterface = $reviewReminderRepositoryInterface;
    }

    /**
     * @throws CouldNotSaveException
     * @throws NoSuchEntityException
     * @throws LocalizedException
     * @throws MailException
     */
    public function execute()
    {
        $numberOfEmails = $this->helperData->getEmailPerCrone();
        $numberOfDays = $this->helperData->getDaysAfter();
        $requireDate = date(
            'Y-m-d h:i:s',
            strtotime(
                '-' . $numberOfDays . ' day',
                strtotime(
                    date('Y-m-d h:i:s')
                )
            )
        );

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create()
            ->addFieldToFilter(
                'status',
                [
                    'eq' => Status::NOT_SEND
                ]
            )
            ->addFieldToFilter('created_at', ['lteq' => $requireDate])
            ->setOrder('created_at', 'ASC')
            ->setPageSize($numberOfEmails);
        if ($collection->count()) {
            foreach ($collection as $item) {
                $this->emailSender->sendApprovalEmail($item);
                $reminder = $this->reviewReminderRepositoryInterface->getById($item->getReminderId());
                $reminder->setStatus(Status::SENT);
                $this->reviewReminderRepositoryInterface->save($reminder);
            }
        }
    }
}
