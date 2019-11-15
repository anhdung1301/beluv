<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Block\Widget;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\Template;
use NiceForNow\HairCare\Model\Config\Source\Active;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\Collection;
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
        DataPersistorInterface $dataPersistor,
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->_dataPersistor = $dataPersistor;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getCondition()
    {
            $conditionId = $this->getRequest()->getParam('id');
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter('condition_id', $conditionId)
            ->addFieldToFilter('is_active', ['eq' => Active::STATUS_ENABLED]);
        return $collection;
    }

    public function getCheckedSelect()
    {
        return $this->getRequest()->getParam('sub_id');
    }
}
