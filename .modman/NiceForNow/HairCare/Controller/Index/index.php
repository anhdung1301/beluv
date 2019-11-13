<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
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
        CollectionFactory $collectionFactory
    ) {
        $this->_dataPersistor = $dataPersistor;
        $this->_pageFactory = $pageFactory;
        $this->_coreRegistry = $_coreRegistry;
        $this->_collectionFactory = $collectionFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPost();

        $post = $this->_collectionFactory->create()
            ->addFieldToFilter('condition_id', ['eq' => $data['condition1']])
            ->addFieldToFilter('sub_id', ['eq' => $data['condition2']]);
        $postData = $post->getData();
        $dataRenderer = [];
        foreach ($postData as $datum) {
            $dataRenderer[$datum['type']][] = $datum;
        }
        $this->_coreRegistry->register('data_beluv', $dataRenderer);

        return $this->_pageFactory->create();
    }
}
