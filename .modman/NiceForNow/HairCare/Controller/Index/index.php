<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\Session\SessionManagerInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use NiceForNow\HairCare\Model\Config\Source\Active;
use NiceForNow\HairCare\Model\ResourceModel\Beluv\CollectionFactory;

/**
 * Class index
 * @package NiceForNow\HairCare\Controller\Index
 */
class index extends Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $_dataPersistor;
    /**
     * @var PageFactory
     */
    protected $_pageFactory;
    /**
     * @var null
     */
    protected $_coreRegistry = null;
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * index constructor.
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param PageFactory $pageFactory
     * @param Registry $_coreRegistry
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        PageFactory $pageFactory,
        Registry $_coreRegistry,
        SessionManagerInterface $coreSession,
        CollectionFactory $collectionFactory
    ) {
        $this->_dataPersistor = $dataPersistor;
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $_coreRegistry;
        $this->_collectionFactory = $collectionFactory;
        $this->_coreSession = $coreSession;
        return parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {

        $page = ($this->getRequest()->getParam('p')) ? $this->getRequest()->getParam('p') : 1;
        $limit = ($this->getRequest()->getParam('limit')) ? $this->getRequest()->getParam('limit') : 2;


        $data = $this->getRequest()->getParams();
        $condition2  = isset($data['condition2'])? $data['condition2'] : null;
        $condition1  =isset($data['condition1'])? $data['condition1'] : null;
        if ($condition2 == null or $data['condition2'] == 0) {
            $collection = $this->_collectionFactory->create()
                ->addFieldToFilter('condition_id', ['eq' => $condition1])
                ->addFieldToFilter('is_active', ['eq' => Active::STATUS_ENABLED]);
        } elseif ($condition2 !== null) {
            $collection = $this->_collectionFactory->create()
                ->addFieldToFilter('condition_id', ['eq' => $condition1])
                ->addFieldToFilter('sub_id', ['eq' => $condition2])
                ->addFieldToFilter('is_active', ['eq' => Active::STATUS_ENABLED]);
        }
        $collection->setPageSize($limit);
        $collection->setCurPage($page);
        $this->_coreRegistry->register('data_beluv', $collection);
        return $this->_pageFactory->create();
    }
}
