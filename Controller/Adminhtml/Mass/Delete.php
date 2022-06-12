<?php

namespace WMZ\ReviewReminder\Controller\Adminhtml\Mass;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use WMZ\ReviewReminder\Api\ReviewReminderRepositoryInterface;
use WMZ\ReviewReminder\Model\ResourceModel\ReviewReminder\CollectionFactory;

class Delete extends Action
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
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ReviewReminderRepositoryInterface $reviewReminderRepositoryInterface
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ReviewReminderRepositoryInterface $reviewReminderRepositoryInterface
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->reviewReminderRepositoryInterface = $reviewReminderRepositoryInterface;
    }

    /**
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $itemsDeleted = 0;
        foreach ($collection->getAllIds() as $id) {
            try {
                $this->reviewReminderRepositoryInterface->deleteById($id);
            } catch (CouldNotDeleteException $exception) {
                $this->messageManager->addErrorMessage(__($exception->getMessage()));
            }
            $itemsDeleted++;
        }
        if ($itemsDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $itemsDeleted)
            );
        }

        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/index/index');
    }
}
