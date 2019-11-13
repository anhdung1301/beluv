<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Controller\Adminhtml;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;

/**
 * Class SubCondition
 * @package NiceForNow\HairCare\Controller\Adminhtml
 */
abstract class SubCondition extends Action
{

    const ADMIN_RESOURCE = 'NiceForNow_HairCare::SubIndex';
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * SubCondition constructor.
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(Context $context, Registry $coreRegistry)
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
        $resultPage->setActiveMenu('NiceForNow_HairCare::custom_sub_condition')
            ->addBreadcrumb(__('SUBCONDITION'), __('SUBCONDITION'))
            ->addBreadcrumb(__('Static SubCondition'), __('Static SubCondition'));
        return $resultPage;
    }
}
