<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Condition;

use Magento\Backend\App\Action\Context;
use NiceForNow\HairCare\Model\ConditionFactory;

/**
 * Class Save
 * @package NiceForNow\HairCare\Controller\Adminhtml\Condition
 */
class Save extends \NiceForNow\HairCare\Controller\Adminhtml\AbstractSave
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'NiceForNow_HariCare::save';
    /**
     * @var ConditionFactory
     */
    protected $modelFactory;
    /**
     * @var string
     */
    protected $idFieldName = 'condition_id';

    /**
     * Save constructor.
     * @param Context $context
     * @param ConditionFactory $conditionFactory
     */
    public function __construct(
        Context $context,
        ConditionFactory $conditionFactory
    ) {
        $this->modelFactory = $conditionFactory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getMessageSuccess()
    {
        return __('save condition success');
    }
}
