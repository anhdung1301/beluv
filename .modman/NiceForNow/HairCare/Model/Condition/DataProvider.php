<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Model\Condition;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory;
use NiceForNow\HairCare\Model\Condition;
/**
 * Class DataProvider
 */
class DataProvider extends ModifierPoolDataProvider
{
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;


    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $blockCollectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        CollectionFactory $blockCollectionFactory,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }

        $data = $this->dataPersistor->get(Condition::CACHE_TAG);
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear(Condition::CACHE_TAG);
        }
        return $this->loadedData;
    }
}
