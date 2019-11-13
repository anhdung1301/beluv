<?php
namespace NiceForNow\HairCare\Model;
class SubCondition extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_sub_condition';

    protected $_cacheTag = 'custom_sub_condition';

    protected $_eventPrefix = 'custom_sub_condition';

    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\ResourceModel\SubCondition');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }

}