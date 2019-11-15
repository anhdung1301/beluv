<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use NiceForNow\HairCare\Model\BeluvFactory;

/**
 * Class Save
 * @package NiceForNow\HairCare\Controller\Adminhtml\Index
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
     * @var BeluvFactory
     */
    protected $modelFactory;
    /**
     * @var string
     */
    protected $idFieldName = 'beluv_id';

    /**
     * Save constructor.
     * @param Context $context
     * @param BeluvFactory $beluvFactory
     */
    public function __construct(
        Context $context,
        BeluvFactory $beluvFactory
    ) {
        $this->modelFactory = $beluvFactory;
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
