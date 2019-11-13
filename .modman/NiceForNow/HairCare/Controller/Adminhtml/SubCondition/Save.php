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
use NiceForNow\HairCare\Model\SubConditionFactory;

class Save extends Action
{
    protected $_postFactory;

    public function __construct(
        Context $context,
        SubConditionFactory $postFactory
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
            } {
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
        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
            return $resultRedirect->setPath('*/*/edit', ['sub_id' => $id, 'duplicate' => '0']);
        }{
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
