<?php
namespace NiceForNow\HairCare\Model;
class Condition extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_condition';

    protected $_cacheTag = 'custom_condition';

    protected $_eventPrefix = 'custom_condition';

    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\ResourceModel\Condition');
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