<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\CollectionFactory as CollectionSubConditionFactory;

use Magento\Framework\App\Request\DataPersistorInterface;

class getajax extends Action
{
    protected $_pageFactory;
    protected $_jsonFactory;

    protected $_collectionSubConditionFactory;


    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        JsonFactory $jsonFactory,
        CollectionSubConditionFactory $collectionSubConditionFactory,
        DataPersistorInterface $dataPersistor

    )
    {
        $this->_jsonFactory = $jsonFactory;
        $this->_pageFactory = $pageFactory;
        $this->_dataPersistor = $dataPersistor;
          $this->_collectionSubConditionFactory = $collectionSubConditionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {


        $conditions = $this->getRequest()->getPostValue();
        $data = $this->_collectionSubConditionFactory->create()
           ->addFieldToFilter('condition_id', ['eq' =>$conditions])->getData();

       return $this->_jsonFactory->create()->setData($data);
    }
}
