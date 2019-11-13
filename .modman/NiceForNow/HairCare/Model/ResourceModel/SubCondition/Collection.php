<?php
namespace NiceForNow\HairCare\Model\ResourceModel\SubCondition;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'sub_id';
    protected $_eventPrefix = 'custom_sub_condition_collection';
    protected $_eventObject = 'collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\SubCondition', 'NiceForNow\HairCare\Model\ResourceModel\SubCondition');
    }

}