<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;

class index extends Action
{
    protected $_dataPersistor;
    protected $_pageFactory;
    protected $_jsonFactory;

    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        PageFactory $pageFactory,
        JsonFactory $jsonFactory
    ) {
        $this->_dataPersistor = $dataPersistor;
        $this->_pageFactory = $pageFactory;
        $this->_jsonFactory = $jsonFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
      return $this->_pageFactory->create();
    }
}
