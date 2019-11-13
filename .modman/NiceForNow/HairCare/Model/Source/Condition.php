<?php

namespace NiceForNow\HairCare\Model\Source;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\OptionSourceInterface;
use NiceForNow\HairCare\Block\Index;

class Condition implements OptionSourceInterface
{
    protected $_resourceConnection;
    protected $options;
    protected $_index;

    public function __construct( ResourceConnection $resourceConnection, Index $index)
    {
        $this->_resourceConnection = $resourceConnection;
        $this->_index = $index;
    }

    public function toOptionArray()
    {
        $configOptions = $this->_index->getCondition();

        $options = [];
        foreach ($configOptions as $key => $value) {
            $options[] = [
                'label' => $value["name"],
                'value' => $value["condition_id"],
            ];
        }
        $this->options = $options;

        return $options;
    }
}
