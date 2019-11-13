<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Condition;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use NiceForNow\HairCare\Model\ConditionFactory;

/**
 * Class Save
 * @package NiceForNow\HairCare\Controller\Adminhtml\Condition
 */
class Save extends Action
{
    /**
     * @var ConditionFactory
     */
    protected $conditionFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param ConditionFactory $conditionFactory
     */
    public function __construct(
        Context $context,
        ConditionFactory $conditionFactory
    ) {
        $this->conditionFactory = $conditionFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     * @throws Exception
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /**
         * @var NiceForNow\HairCare\Model\Condition $model
         */
        $model = $this->conditionFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        try {
            $id = $data['condition_id'] ? $data['condition_id'] : null;
            $id == null ? $msg = __('add record success') : $msg = __('Edit record success');

            if (isset($data['condition_id']) && !$id) {
                unset($data['condition_id']);
            }
            if ($id) {
                $model->load($id);
                $model->addData([
                    "condition_id" => (int)$data['condition_id'],
                    "name" => $data['name'],
                ]);
                $model->save();
            }
            {
                $model->addData([
                    "name" => $data['name'],
                ]);
                $model->save();
            }
            $model->load($id);

            $model->setUrlKey($model->beforeSave());
            $this->messageManager->addSuccessMessage($msg);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        if ($this->getRequest()->getParam('back')) {
            return $resultRedirect->setPath('*/*/edit', ['condition_id' => $id, 'duplicate' => '0']);
        }
        {
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
