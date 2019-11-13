<?php

namespace NiceForNow\HairCare\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class BeluvType implements OptionSourceInterface
{
    /**
     * @var \NiceForNow\HairCare\Model\Beluv
     */
    protected $_beluv;

    /**
     * IsActive constructor.
     * @param \NiceForNow\HairCare\Model\Beluv $beluv
     */
    public function __construct(\NiceForNow\HairCare\Model\Beluv $beluv)
    {
        $this->_beluv = $beluv;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->_beluv->getAvailableType();
        $options = [];

        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}




