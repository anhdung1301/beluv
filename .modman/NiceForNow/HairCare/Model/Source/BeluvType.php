<?php
namespace  NiceForNow\HairCare\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class BeluvType implements OptionSourceInterface
{
    public function toOptionArray()
    {
        $configOptions=array(
            0=>"Tại salon",
            1=>"Tại nhà hàng ngày",
            2=>"Tại nhà hàng tuần"
        );
        $options = [];
        foreach ($configOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        $this->options = $options;

        return $options;
    }
}
