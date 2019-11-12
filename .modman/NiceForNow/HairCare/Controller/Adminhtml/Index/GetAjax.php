<?php

namespace NiceForNow\HairCare\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use \Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResourceConnection;

class GetAjax extends Action
{
    protected $request;
    protected $resultJsonFactory;

    public function __construct(Context $context, Http $request,
                                \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
                                ResourceConnection $resourceConnection
    )
    {

        $this->request = $request;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_resourceConnection = $resourceConnection;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $id = $this->getRequest()->getPost('id');

        $configOptions = $this->getSubCondition($id);
        $options = [];
        foreach ($configOptions as $key => $value) {
            $options[] = [
                'label' => $value["name"],
                'value' => $value["sub_id"]
            ];
        }
        $this->options = $options;
        return $resultJson->setData($options);
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