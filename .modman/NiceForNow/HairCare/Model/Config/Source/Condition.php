<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use NiceForNow\HairCare\Model\ResourceModel\Condition\Collection;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory;

/**
 * Class Condition
 * @package NiceForNow\HairCare\Model\Config\Source
 */
class Condition implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Condition constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * To option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create()
            ->addFieldToFilter('is_active', ['eq' => Active::STATUS_ENABLED]);
        return $collection->toOptionArray();
    }
}
