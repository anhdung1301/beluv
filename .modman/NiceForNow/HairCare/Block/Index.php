<?php

namespace NiceForNow\HairCare\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Rss\Model\UrlBuilder;
use NiceForNow\HairCare\Model\BeluvFactory;
use NiceForNow\HairCare\Model\ResourceModel\Beluv\CollectionFactory;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory as CollectionConditionFactory;

class Index extends Template
{
    /**
     * @var BeluvFactory
     */
    protected $_dataFactory;
    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;
    /**
     * @var DataPersistorInterface
     */
    protected $_dataPersistor;
    /**
     * @var UrlBuilder
     */
    protected $_urlBuilder;
    /**
     * @var CollectionConditionFactory
     */
    protected $_collectionConditionFactory;
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param BeluvFactory $dataFactory
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param UrlBuilder $urlBuilder
     * @param CollectionConditionFactory $collectionConditionFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BeluvFactory $dataFactory,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        UrlBuilder $urlBuilder,
        CollectionConditionFactory $collectionConditionFactory,
        Registry $_coreRegistry
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_dataFactory = $dataFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_dataPersistor = $dataPersistor;
        $this->_urlBuilder = $urlBuilder;
        $this->_collectionConditionFactory = $collectionConditionFactory;
        $this->_coreRegistry = $_coreRegistry;
        parent::__construct($context);
    }

    /**
     * @return array
     */
    public function getCondition()
    {
        $data = $this->_collectionConditionFactory->create();
        return $data->getData();
    }

    /**
     * @return array
     */
    public function getPostCollection()
    {
        return $this->_coreRegistry->registry('data_beluv');
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }

    /**
     * @param $id
     * @return |null
     */
    public function getType($id)
    {
        $type = null;
        $data = $this->_dataFactory->create()->getAvailableType();
        foreach ($data as $item => $value) {
            if ($item == $id) {
                $type = $value;
            }
        }
        return $type;
    }
}
