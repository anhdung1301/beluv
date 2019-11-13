<?php

namespace NiceForNow\HairCare\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\CollectionFactory;

class SubCondition implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var null
     */
    protected $options = null;

    /**
     * SubCondition constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        /**
         *  @var \NiceForNow\HairCare\Model\ResourceModel\SubCondition\Collection $configOptions
         */
        $configOptions = $this->collectionFactory->create();
        if (empty($this->options)) {
            $this->options = $configOptions->toOptionArray();
        }
        return $this->options;
    }
}
