<?php

namespace NiceForNow\HairCare\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class GetAjax
 * @package NiceForNow\HairCare\Controller\Adminhtml\Index
 */
class GetAjax extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NiceForNow_HariCare::save';
    /**
     * @var Http
     */
    protected $request;
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @var ResourceConnection
     */
    protected $_resourceConnection;

    /**
     * GetAjax constructor.
     * @param Context $context
     * @param Http $request
     * @param JsonFactory $resultJsonFactory
     * @param ResourceConnection $resourceConnection
     */
    public function __construct(
        Context $context,
        Http $request,
        JsonFactory $resultJsonFactory,
        ResourceConnection $resourceConnection
    )
    {
        $this->request = $request;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_resourceConnection = $resourceConnection;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultJsonFactory->create();
        $id = $this->getRequest()->getPost('id');

        $configOptions = $this->getSubCondition($id);
        $options = [];
        foreach ($configOptions as $value) {
            $options[] = [
                'label' => $value["name"],
                'value' => $value["sub_id"]
            ];
        }
        $this->options = $options;
        return $resultJson->setData($options);
    }

    /**
     * @param $subCondition
     * @return array
     */
    public function getSubCondition($subCondition)
    {
        /** @var  $connection */
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
