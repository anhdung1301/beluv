<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\Result\PageFactory;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\CollectionFactory as CollectionSubConditionFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\ResultInterface;

use Magento\Framework\App\Request\DataPersistorInterface;

class getajax extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var JsonFactory
     */
    protected $_jsonFactory;

    /**
     * @var CollectionSubConditionFactory
     */
    protected $_collectionSubConditionFactory;

    /**
     * getajax constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param JsonFactory $jsonFactory
     * @param CollectionSubConditionFactory $collectionSubConditionFactory
     * @param DataPersistorInterface $dataPersistor
     */
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

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $conditions = $this->getRequest()->getPostValue();
        $data = $this->_collectionSubConditionFactory->create()
           ->addFieldToFilter('condition_id', ['eq' =>$conditions])->getData();
       return $this->_jsonFactory->create()->setData($data);
    }
}
