<?php
namespace NiceForNow\HairCare\Model\ResourceModel\Condition;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'condition_id';
    protected $_eventPrefix = 'custom_condition_collection';
    protected $_eventObject = 'collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\Condition', 'NiceForNow\HairCare\Model\ResourceModel\Condition');
    }

}
