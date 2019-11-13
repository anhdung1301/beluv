<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\HairCare\Controller\Adminhtml;
/**
 * Class Beluv
 * @package NiceForNow\HairCare\Controller\Adminhtml
 */
abstract class Beluv extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'NiceForNow_HairCare::Index';
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * Beluv constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\Registry $coreRegistry)
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * @param $resultPage
     * @return mixed
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('NiceForNow_HairCare::custom_beluv')
            ->addBreadcrumb(__('HAIRCARE'), __('HAIRCARE'))
            ->addBreadcrumb(__('Static Haircare'), __('Static Haircare'));
        return $resultPage;
    }
}
