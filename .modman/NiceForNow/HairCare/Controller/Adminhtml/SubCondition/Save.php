<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\SubCondition;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use NiceForNow\HairCare\Model\SubConditionFactory;

/**
 * Class Save
 * @package NiceForNow\HairCare\Controller\Adminhtml\SubCondition
 */
class Save extends Action
{
    /**
     * @var
     */
    protected $subCondition;

    /**
     * Save constructor.
     * @param Context $context
     * @param SubConditionFactory $subCondition
     */
    public function __construct(
        Context $context,
        SubConditionFactory $subCondition
    ) {
        $this->subCondition = $subCondition;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /**
         * @var NiceForNow\HairCare\Model\Beluv $model
         */
        $model = $this->subCondition->create();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $id = $data['sub_id'] ? $data['sub_id'] : null;
            $id == null ? $msg = __('add record success') : $msg = __('Edit record success');
            if (isset($data['sub_id']) && !$id) {
                unset($data['sub_id']);
            }
            if ($id) {
                $model->load($id);
                $model->addData([
                    "sub_id" => (int)$data['sub_id'],
                    "name" => $data['name'],
                    "condition_id" => (int)$data['condition_id']
                ]);
                $model->save();
            }
            {
                $model->addData([
                    "name" => $data['name'],
                    "condition_id" => (int)$data['condition_id']
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
            return $resultRedirect->setPath('*/*/edit', ['sub_id' => $id, 'duplicate' => '0']);
        }
        {
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
