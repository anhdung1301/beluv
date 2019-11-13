<?php

namespace NiceForNow\HairCare\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Rss\Model\UrlBuilder;
use NiceForNow\HairCare\Model\BeluvFactory;
use NiceForNow\HairCare\Model\ResourceModel\Beluv\CollectionFactory;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory as CollectionConditionFactory;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\CollectionFactory as CollectionSubConditionFactory;

class Index extends Template
{
    protected $_dataFactory;

    protected $_collectionFactory;
    protected $_dataPersistor;
    protected $_urlBuilder;
    protected $_collectionConditionFactory;
    protected $_collectionSubConditionFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BeluvFactory $dataFactory,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        UrlBuilder $urlBuilder,
        CollectionConditionFactory $collectionConditionFactory,
        CollectionSubConditionFactory $collectionSubConditionFactory
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_dataFactory = $dataFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_dataPersistor = $dataPersistor;
        $this->_urlBuilder = $urlBuilder;
        $this->_collectionConditionFactory = $collectionConditionFactory;
        $this->_collectionSubConditionFactory = $collectionSubConditionFactory;
        parent::__construct($context);
    }

    public function getCondition()
    {
        $data = $this->_collectionConditionFactory->create();
        return $data->getData();
    }

    public function getSubCondition()
    {
        $data = $this->_collectionSubConditionFactory->create();
        return $data->getData();
    }

    public function getPostCollection()
    {
        $data = $this->_dataPersistor->get('condition');
        $post = $this->_collectionFactory->create()
            ->addFieldToFilter('condition_id', ['eq' => $data['condition1']])
            ->addFieldToFilter('sub_id', ['eq' => $data['condition2']]);
        $postData = $post->getData();
        $dataRenderer = [];
        foreach ($postData as $datum) {
            $dataRenderer[$datum['type']][] = $datum;
        }
        $this->_dataPersistor->clear('condition');
        return $dataRenderer;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }

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
