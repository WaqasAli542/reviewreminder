<?php

namespace WMZ\ReviewReminder\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Data
{
    const XML_PATH_WMZ = 'review_reminder/general/';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Data constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getConfigValue($field)
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_WMZ . $field,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * @return mixed
     */
    public function getDaysAfter()
    {
        return $this->getConfigValue('days_after');
    }

    /**
     * @return mixed
     */
    public function getEmailPerCrone()
    {
        return $this->getConfigValue('emails_per_cron');
    }

    /**
     * @return mixed
     */
    public function getEmailTemplate()
    {
        return $this->getConfigValue('email_template');
    }

    /**
     * @return mixed
     */
    public function getSenderEmail()
    {
        return $this->getConfigValue('sender_email');
    }

    /**
     * @return mixed
     */
    public function getOrderStatus()
    {
        return $this->getConfigValue('order_status');
    }
}
