<?php

namespace NiceForNow\HairCare\Model;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Beluv extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'custom_beluv';

    protected $_cacheTag = 'custom_beluv';

    protected $_eventPrefix = 'custom_beluv';


    protected function _construct()
    {
        $this->_init('NiceForNow\HairCare\Model\ResourceModel\Beluv');
    }

    /**
     * @return array|string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}