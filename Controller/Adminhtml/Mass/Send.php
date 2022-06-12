<?php

namespace WMZ\ReviewReminder\Controller\Adminhtml\Mass;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use WMZ\ReviewReminder\Api\ReviewReminderRepositoryInterface;
use WMZ\ReviewReminder\Model\Config\Source\Status;
use WMZ\ReviewReminder\Model\Reminder\EmailSender;
use WMZ\ReviewReminder\Model\ResourceModel\ReviewReminder\CollectionFactory;

class Send extends Action
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var ReviewReminderRepositoryInterface
     */
    private $reviewReminderRepositoryInterface;

    /**
     * @var EmailSender
     */
    private $emailSender;

    /**
     * Send constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ReviewReminderRepositoryInterface $reviewReminderRepositoryInterface
     * @param EmailSender $emailSender
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ReviewReminderRepositoryInterface $reviewReminderRepositoryInterface,
        EmailSender $emailSender
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->reviewReminderRepositoryInterface = $reviewReminderRepositoryInterface;
        $this->emailSender = $emailSender;
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $items = 0;
        foreach ($collection as $reminderItem) {
            try {
                $this->emailSender->sendApprovalEmail($reminderItem);
                $reminder = $this->reviewReminderRepositoryInterface->getById($reminderItem->getReminderId());
                $reminder->setStatus(Status::SENT);
                $this->reviewReminderRepositoryInterface->save($reminder);
                $items++;
            } catch (LocalizedException $exception) {
                $this->messageManager->addErrorMessage(__($exception->getMessage()));
            }
        }

        if ($items) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been updated.', $items)
            );
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/index/index');
    }
}
