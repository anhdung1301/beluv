<?php

namespace NiceForNow\HairCare\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{

    protected $blogs;


    public function __construct(\NiceForNow\HairCare\Model\Beluv $beluv)
    {
        $this->beluv = $beluv;
    }
    public function toOptionArray()
    {
        $availableOptions = $this->beluv->getAvailableType();
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




