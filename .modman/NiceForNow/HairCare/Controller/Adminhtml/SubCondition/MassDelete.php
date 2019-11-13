<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace  NiceForNow\HairCare\Controller\Adminhtml\SubCondition;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use NiceForNow\HairCare\Model\ResourceModel\SubCondition\CollectionFactory;
use NiceForNow\HairCare\Model\SubConditionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    const ADMIN_RESOURCE = 'NiceForNow_HairCare::index';

    protected $filter;

    protected $collectionFactory;

    protected $_beluvFactory;


    public function __construct(Context $context, Filter $filter,
                                CollectionFactory $collectionFactory,
                                SubConditionFactory $beluvFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->_beluvFactory =$beluvFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());

        $collectionSize = $collection->getSize();

        foreach ($collection as $item)
        {
            $item = $this->_beluvFactory->create()->load($item->getId());
            $item->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));


        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }
}
