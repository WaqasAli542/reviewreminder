<?php

namespace WMZ\ReviewReminder\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    const NOT_SEND = 0;
    const SENT = 1;

    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['label' => __('Not Send'), 'value' => self::NOT_SEND],
            ['label' => __('Sent'), 'value' => self::SENT]
        ];
    }
}
