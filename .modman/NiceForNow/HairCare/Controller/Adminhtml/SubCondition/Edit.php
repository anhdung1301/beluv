<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\SubCondition;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use NiceForNow\HairCare\Model\SubCondition;

/**
 * Class Edit
 * @package NiceForNow\HairCare\Controller\Adminhtml\SubCondition
 */
class Edit extends \NiceForNow\HairCare\Controller\Adminhtml\SubCondition implements HttpGetActionInterface
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * @return Page|Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('sub_id');
        $model = $this->_objectManager->create(SubCondition::class);
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This block no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('custom_sub_condition', $model);
        // 5. Build edit form
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit SubCondition') : __('New SubCondition'),
            $id ? __('Edit SubCondition') : __('New SubCondition')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('SubCondition'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit SubCondition') : __('New SubCondition'));
        return $resultPage;
    }

}
