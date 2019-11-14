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
class BeluvType implements OptionSourceInterface
{
    const TYPE_SALON = 0;
    const TYPE_HOME_DAILY = 1;
    const TYPE_HOME_WEEKLY = 2;


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
            self::TYPE_SALON => __('Tại salon'),
            self::TYPE_HOME_DAILY => __('Tại nhà hàng ngày'),
            self::TYPE_HOME_WEEKLY => __('Tại nhà hàng tuần')
        ];
    }
}
