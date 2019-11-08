<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Ui\Component\Listing\Columns;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Stdlib\BooleanUtils;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;


/**
 * Date format column
 *
 * @api
 * @since 100.0.2
 */
class DataCondition extends Column
{


    protected $_resourceConnection;
    /**
     * @var BooleanUtils
     */
    private $booleanUtils;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        BooleanUtils $booleanUtils,
        array $components = [],
        array $data = [],
        ResourceConnection $resourceConnection
    )
    {
        $this->booleanUtils = $booleanUtils;
        $this->_resourceConnection = $resourceConnection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @inheritdoc
     * @since 101.1.1
     */


    /**
     * @inheritdoc
     */
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as $key => $item ) {
            foreach ($this->getCondition($item['condition_id']) as $idx)
            {
                if($item['condition_id']=$idx['condition_id']){
                    $dataSource['data']['items'][$key]['condition_id']=$idx['name'];
                }
            }
            foreach ($this->getSubCondition($item['condition_id']) as $idx)
            {
                if($item['condition_id']=$idx['condition_id']){
                    $dataSource['data']['items'][$key]['sub_id']=$idx['name'];
                }
            }
        }

        return $dataSource;
    }

    public function getCondition($condition)
    {
        $connection = $this->_resourceConnection->getConnection();

        $select = $connection->select()
            ->from(
                ['ce' => 'custom_condition']
            )
           ->where('condition_id = ?', $condition);
        $data = $connection->fetchAll($select);
        return $data;
    }
    public function getSubCondition($subCondition)
    {
        $connection = $this->_resourceConnection->getConnection();
        $select = $connection->select()
            ->from(
                ['ce' => 'custom_sub_condition']
            )
            ->where('condition_id = ?', $subCondition);
        $data = $connection->fetchAll($select);
        return $data;

    }


}
