<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\HairCare\Controller\Adminhtml;

abstract class Condition extends \Magento\Backend\App\Action
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
        $resultPage->setActiveMenu('NiceForNow_HairCare::custom_condition')
            ->addBreadcrumb(__('CONDITION'), __('CONDITION'))
            ->addBreadcrumb(__('Static Condition'), __('Static Condition'));
        return $resultPage;
    }
}
