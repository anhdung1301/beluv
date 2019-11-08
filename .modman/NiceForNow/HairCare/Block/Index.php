<?php

namespace NiceForNow\HairCare\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use NiceForNow\HairCare\Model\BeluvFactory;
use NiceForNow\HairCare\Model\ResourceModel\Beluv\CollectionFactory;
use Magento\Rss\Model\UrlBuilder;
class Index extends Template
{
    protected $_dataFactory;
    protected $_resourceConnection;
    protected $_collectionFactory;
    protected $_dataPersistor;
    protected $_urlBuilder;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ResourceConnection $resourceConnection,
        BeluvFactory $dataFactory,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        UrlBuilder $urlBuilder
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_dataFactory = $dataFactory;
        $this->_resourceConnection = $resourceConnection;
        $this->_collectionFactory = $collectionFactory;
        $this->_dataPersistor = $dataPersistor;
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context);
    }

    public function getCondition()
    {
        $connection = $this->_resourceConnection->getConnection();
        $select = $connection->select()
            ->from(
                ['ce' => 'custom_condition']
            );
//            ->where('condition_id = ?', 1);
        $data = $connection->fetchAll($select);
        return $data;
    }

    public function getSubCondition()
    {
        $connection = $this->_resourceConnection->getConnection();
        $select = $connection->select()
            ->from(
                ['ce' => 'custom_sub_condition']
            );
        $data = $connection->fetchAll($select);
        return $data;
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
        return $dataRenderer;
    }
    public function getUrl($route = '', $params = [])
    {
        return $this->_urlBuilder->getUrl($route, $params);
    }
    public function getType($name){
        $type="";
        switch ($name){
            case 0:
                $type="Tại Salon";
                break;
            case 1:
                $type="Tại nhà hàng ngày";
                break;
            case 2:
                $type="Tại nhà hàng tuần";
                break;
            default:
                break;
        }
        return $type;
    }

}
