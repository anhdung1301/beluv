<?php
namespace  NiceForNow\HairCare\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;


class BeluvType implements OptionSourceInterface
{

    protected $pageLayoutBuilder;

    protected $options;


    public function __construct(BuilderInterface $pageLayoutBuilder)
    {
        $this->pageLayoutBuilder = $pageLayoutBuilder;
    }


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
