<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\Haircare\Model\Beluv;

use NiceForNow\Haircare\Model\ResourceModel\Beluv\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
class DataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $post) {

            $this->loadedData[$post->getId()]['post'] = $post->getData();

        }

        return $this->loadedData;
        var_dump($this->loadedData); die;
    }

}