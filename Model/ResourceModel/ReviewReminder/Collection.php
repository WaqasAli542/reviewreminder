<?php

namespace WMZ\ReviewReminder\Model\ResourceModel\ReviewReminder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use WMZ\ReviewReminder\Api\Data\ReviewReminderInterface;
use WMZ\ReviewReminder\Model\ResourceModel\ReviewReminder as ReviewReminderResourceModel;
use WMZ\ReviewReminder\Model\ReviewReminder as ReviewReminderModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = ReviewReminderInterface::REMINDER_ID;

    /**
     * Declaration of Model and Resource Model
     */
    public function _construct()
    {
        $this->_init(
            ReviewReminderModel::class,
            ReviewReminderResourceModel::class
        );
    }
}
