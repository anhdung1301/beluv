<?php

namespace NiceForNow\HairCare\Model\Source;
use NiceForNow\HairCare\Model\Config\Source\Active;
use Magento\Framework\Data\OptionSourceInterface;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory;

/**
 * Class Condition
 * @package NiceForNow\HairCare\Model\Source
 */
class Condition implements OptionSourceInterface
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
     * Condition constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return array|null
     */
    public function toOptionArray()
    {
        /** @var \NiceForNow\HairCare\Model\ResourceModel\Condition\Collection $configOptions */
        $configOptions = $this->collectionFactory->create()
            ->addFieldToFilter('is_active', ['eq' => Active::STATUS_ENABLED]);
        if (empty($this->options)) {
            $this->options = $configOptions->toOptionArray();
        }

        return $this->options;
    }
}
