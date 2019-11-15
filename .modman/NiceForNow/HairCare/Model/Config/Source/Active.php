<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class Type
 * @package NiceForNow\HairCare\Model\Config\Source
 */
class Active implements OptionSourceInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;


    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = $this->toArray();
        $return = [];

        foreach ($options as $value => $label) {
            $return[] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $return;
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            self::STATUS_ENABLED =>__('Enabled'),
            self::STATUS_DISABLED => __('Disabled'),
        ];
    }
}
