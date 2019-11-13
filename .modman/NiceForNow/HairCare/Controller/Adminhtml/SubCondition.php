<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\HairCare\Controller\Adminhtml;

abstract class SubCondition extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'haircare::block';

    protected $_coreRegistry;


    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('NiceForNow_HairCare::custom_sub_condition')
            ->addBreadcrumb(__('SUBCONDITION'), __('SUBCONDITION'))
            ->addBreadcrumb(__('Static SubCondition'), __('Static SubCondition'));
        return $resultPage;
    }
}
