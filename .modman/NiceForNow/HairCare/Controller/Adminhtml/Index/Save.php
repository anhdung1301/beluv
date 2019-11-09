<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Index;

use NiceForNow\HairCare\Model\BeluvFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    protected $postFactory;

    public function __construct(
        Context $context,
        BeluvFactory $postFactory
    )
    {
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $model = $this->_postFactory->create();
        $resultRedirect = $this->resultRedirectFactory->create();
        //$this->processResultRedirect($model,$resultRedirect,$data);
        try {
            $msg = __('add record success');
            if ($id = !null) {
                $msg = __('Edit record success');
            }
            if (isset($data['beluv_id']) && !$id) {
                unset($data['beluv_id']);
            }
                $model->load($id);
                $model->addData([
                    "condition_id" => $data['condition_id'],
                    "sub_id" => $data['sub_id'],
                    "type" => $data['type'],
                    "title" => $data['title'],
                    "description" => $data['description'],
                ]);
                $model->save();
            $model->setUrlKey($model->beforeSave());

            $this->messageManager->addSuccessMessage($msg);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        if ($this->getRequest()->getParam('back', false) === 'duplicate') {
            return $resultRedirect->setPath('*/*/edit', ['beluv_id' => $id, 'duplicate' => '0']);
        } else {
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
