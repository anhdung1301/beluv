<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Block\Widget;

use Magento\Framework\View\Element\Template;
use NiceForNow\HairCare\Model\Config\Source\Active;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\CollectionFactory;

class SubCondition extends Template
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var string
     */
    protected $_template = 'NiceForNow_HairCare::widget/condition.phtml';

    /**
     * Index constructor.
     * @param CollectionFactory $collectionFactory
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Template\Context $context,
        array $data = []
    )
    {
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getCondition()
    {
        $conditionId = $this->getRequest()->getParam('id');
        /** @var \NiceForNow\HairCare\Model\ResourceModel\SubCondition\Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('condition_id', $conditionId)
            ->addFieldToFilter('is_active', ['eq' => Active::STATUS_ENABLED]);
        return $collection;
    }
}
