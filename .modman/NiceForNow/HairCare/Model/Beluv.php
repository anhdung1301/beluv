<?php
namespace NiceForNow\HairCare\Model;
class Beluv extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'custom_beluv';

    protected $_cacheTag = 'custom_beluv';

    protected $_eventPrefix = 'custom_beluv';

    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\ResourceModel\Beluv');
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