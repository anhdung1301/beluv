<?php

namespace NiceForNow\HairCare\Controller\Adminhtml;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class AbstractMassDelete
 * @package NiceForNow\HairCare\Controller\Adminhtml
 */
abstract class AbstractMassDelete extends Action implements HttpPostActionInterface
{

    /**
     * @var null
     */
    protected $context;

    /**
     * AbstractMassDelete constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->getModel());

        $collectionSize = $collection->getSize();

        foreach ($collection as $item) {
            $item = $this->getModel()->load($item->getId());
            $item->delete();
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * return mixin
     */
    public function getModel()
    {
        return $this->modelFactory->create();
    }
}
