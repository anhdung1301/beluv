<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\HairCare\Controller\Adminhtml;

abstract class Beluv extends \Magento\Backend\App\Action
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
        $resultPage->setActiveMenu('NiceForNow_HairCare::custom_beluv')
            ->addBreadcrumb(__('HAIRCARE'), __('HAIRCARE'))
            ->addBreadcrumb(__('Static Haircare'), __('Static Haircare'));
        return $resultPage;
    }
}
