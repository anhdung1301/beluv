<?php
namespace NiceForNow\HairCare\Model\ResourceModel\Beluv;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'beluv_id';
    protected $_eventPrefix = 'custom_beluv_collection';
    protected $_eventObject = 'collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\Beluv', 'NiceForNow\HairCare\Model\ResourceModel\Beluv');
    }

}