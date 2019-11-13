<?php
namespace  NiceForNow\HairCare\Model\Source;
use Magento\Framework\Data\OptionSourceInterface;
use NiceForNow\HairCare\Block\Index;
class SubCondition implements OptionSourceInterface
{
    protected $resourceConnection;
    protected $options;
    protected $_index;


    public function __construct(Index $index)
    {
        $this->_index = $index;
    }
    public function toOptionArray()
    {
        $configOptions=$this->_index->getSubCondition();
        $options = [];
        foreach ($configOptions as  $value) {
            $options[] = [
                'label' => $value["name"],
                'value' => $value["sub_id"],
            ];
        }
        $this->options = $options;
        return $options;
    }

}