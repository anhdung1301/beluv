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
 * Class Condition
 * @package NiceForNow\HairCare\Controller\Adminhtml
 */
abstract class Condition extends Action
{

    const ADMIN_RESOURCE = 'NiceForNow_HairCare::Condition';
    /**
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Condition constructor.
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
        $resultPage->setActiveMenu('NiceForNow_HairCare::custom_condition')
            ->addBreadcrumb(__('CONDITION'), __('CONDITION'))
            ->addBreadcrumb(__('Static Condition'), __('Static Condition'));
        return $resultPage;
    }
}
