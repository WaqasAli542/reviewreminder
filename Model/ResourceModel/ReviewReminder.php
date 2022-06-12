<?php

namespace WMZ\ReviewReminder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use WMZ\ReviewReminder\Api\Data\ReviewReminderInterface;

class ReviewReminder extends AbstractDb
{
    const TABLE_NAME = 'wmz_review_reminder';

    /**
     * Declaration of Table and Primary Key
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, ReviewReminderInterface::REMINDER_ID);
    }
}
