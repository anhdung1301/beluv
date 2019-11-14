<?php

namespace NiceForNow\HairCare\Block;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Rss\Model\UrlBuilder;
use NiceForNow\HairCare\Model\BeluvFactory;
use NiceForNow\HairCare\Model\ResourceModel\Beluv\CollectionFactory;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory as CollectionConditionFactory;
use NiceForNow\HairCare\Model\Config\Source\BeluvType;

class Index extends Template
{
    /**
     * @var BeluvFactory
     */
    protected $_beluvFactory;
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
     * @var BeluvType
     */
    protected $beluvType;
    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param BeluvFactory $beluvFactory
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param UrlBuilder $urlBuilder
     * @param CollectionConditionFactory $collectionConditionFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        BeluvFactory $beluvFactory,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        UrlBuilder $urlBuilder,
        CollectionConditionFactory $collectionConditionFactory,
        Registry $_coreRegistry,
        BeluvType $beluvType
    ) {
        $this->_pageFactory = $pageFactory;
        $this->_beluvFactory = $beluvFactory;
        $this->_collectionFactory = $collectionFactory;
        $this->_dataPersistor = $dataPersistor;
        $this->_urlBuilder = $urlBuilder;
        $this->_collectionConditionFactory = $collectionConditionFactory;
        $this->_coreRegistry = $_coreRegistry;
        $this->beluvType = $beluvType;
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

        $data = $this->beluvType->toArray();
        foreach ($data as $item => $value) {
            if ($item == $id) {
                $type = $value;
            }
        }
        return $type;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return $this|Template
     * @throws LocalizedException
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($this->getListNews()) {
            $pager = $this->getLayout()->createBlock('Magento\Theme\Block\Html\Pager', 'nicefornow.haircare.pager')
                ->setAvailableLimit([6 => 6, 10 => 10, 15 => 15, 20 => 20])
                ->setShowPerPage(true)
                ->setCollection($this->getListNews());


            $this->setChild('pager', $pager);

            $this->getListNews()->load();
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListNews()
    {
        return $this->_coreRegistry->registry('data_beluv');

    }
}
