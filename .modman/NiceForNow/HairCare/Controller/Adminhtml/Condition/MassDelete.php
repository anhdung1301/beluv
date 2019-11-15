<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Condition;

use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use NiceForNow\HairCare\Controller\Adminhtml\AbstractMassDelete;
use NiceForNow\HairCare\Model\ResourceModel\Condition\CollectionFactory;

/**
 * Class MassDelete
 */
class MassDelete extends AbstractMassDelete
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NiceForNow_HairCare::page_delete';
    /**
     * @var CollectionFactory
     */
    protected $modelFactory;
    /**
     * @var Filter|null
     */
    protected $filter = null ;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory
    )
    {
        $this->modelFactory = $collectionFactory;
        $this->filter = $filter;
        parent::__construct($context);
    }

}