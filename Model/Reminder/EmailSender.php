<?php

namespace WMZ\ReviewReminder\Model\Reminder;

use Magento\Framework\App\Area;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Url;
use Magento\Store\Model\StoreManagerInterface;
use WMZ\ReviewReminder\Helper\Data;

class EmailSender
{
    /**
     * @var TransportBuilder
     */
    private $transportBuilder;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Data
     */
    private $helperData;

    /**
     * @param TransportBuilder $transportBuilder
     * @param StoreManagerInterface $storeManager
     * @param Data $helperData
     */
    public function __construct(
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager,
        Data $helperData
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        $this->helperData = $helperData;
    }

    /**
     * @param $reminderItem
     * @throws LocalizedException
     * @throws MailException
     * @throws NoSuchEntityException
     */
    public function sendApprovalEmail($reminderItem)
    {
        if (isset($reminderItem)) {
            $this->sendEmail(
                $this->helperData->getEmailTemplate(),
                $this->storeManager->getStore()->getId(),
                $reminderItem,
                $reminderItem->getCustomerEmail()
            );
        }
    }

    /**
     * @param $templateIdentifier
     * @param $storeId
     * @param $templateVars
     * @param $sendTo
     * @param string $area
     * @throws LocalizedException
     * @throws MailException
     */
    private function sendEmail($templateIdentifier, $storeId, $templateVars, $sendTo, $area = Area::AREA_FRONTEND)
    {
        $transport = $this->transportBuilder
            ->setTemplateIdentifier($templateIdentifier)
            ->setTemplateOptions(
                ['area' => $area, 'store' => $storeId]
            )
            ->setTemplateVars(['data' => $templateVars])
            ->setFromByScope(
                $this->helperData->getSenderEmail(),
                $storeId
            )
            ->addTo([$sendTo])
            ->getTransport();
        $transport->sendMessage();
    }
}
