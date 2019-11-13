<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Condition;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use NiceForNow\HairCare\Model\ConditionFactory;

class Save extends Action
{
    protected $postFactory;

    public function __construct(
        Context $context,
        ConditionFactory $postFactory
    ) {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->_postFactory->create();
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
            }{
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
        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
            return $resultRedirect->setPath('*/*/edit', ['condition_id' => $id, 'duplicate' => '0']);
        }
        {
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
