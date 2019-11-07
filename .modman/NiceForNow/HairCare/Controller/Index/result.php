<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use NiceForNow\HairCare\Model\ResourceModel\Beluv\CollectionFactory;

class result extends Action
{
    protected $_pageFactory;
    protected $_jsonFactory;
    protected $_collectionFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $jsonFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->_collectionFactory = $collectionFactory;
        $this->_jsonFactory = $jsonFactory;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $conditions = $this->getRequest()->getPostValue();
        $conditionsArray = [
            "condition1" => $conditions["condition1"],
            "condition2" => $conditions["condition2"]
        ];

        $post = $this->_collectionFactory->create()
            ->addFieldToFilter('condition_id', ['eq' => $conditionsArray['condition1']])
            ->addFieldToFilter('sub_id', ['eq' => $conditionsArray['condition2']]);
        $postData = $post->getData();
        $dataRenderer = [];
        foreach ($postData as $datum) {
            $dataRenderer[$datum['type']][] = $datum;
        }

        return $this->_jsonFactory->create()->setData($dataRenderer);
    }
}
