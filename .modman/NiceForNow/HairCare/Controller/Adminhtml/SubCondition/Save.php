<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\SubCondition;

use Magento\Backend\App\Action\Context;
use NiceForNow\HairCare\Controller\Adminhtml\AbstractSave;
use NiceForNow\HairCare\Model\SubConditionFactory;

/**
 * Class Save
 * @package NiceForNow\HairCare\Controller\Adminhtml\SubCondition
 */
class Save extends AbstractSave
{
    /**
     * @var SubConditionFactory
     */
    protected $modelFactory;
    /**
     * @var string
     */
    protected $idFieldName = 'sub_id';

    /**
     * Save constructor.
     * @param Context $context
     * @param BeluvFactory $beluvFactory
     */
    public function __construct(
        Context $context,
        SubConditionFactory $subConditionFactory
    )
    {
        $this->modelFactory = $subConditionFactory;
        parent::__construct($context);
    }

    /**
     * @return string
     */
    public function getMessageSuccess()
    {
        return __('save HairCare success');
    }
}