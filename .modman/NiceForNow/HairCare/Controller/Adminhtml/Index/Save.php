<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */

namespace NiceForNow\HairCare\Controller\Adminhtml\Index;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use NiceForNow\HairCare\Model\BeluvFactory;

/**
 * Class Save
 * @package NiceForNow\HairCare\Controller\Adminhtml\Index
 */
class Save extends Action
{
    /**
     * @var BeluvFactory
     */
    protected $beluvFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param BeluvFactory $beluvFactory
     */
    public function __construct(
        Context $context,
        BeluvFactory $beluvFactory
    ) {
        $this->beluvFactory = $beluvFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\Result\Redirect|ResultInterface
     * @throws Exception
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /**
         * @var NiceForNow\HairCare\Model\Beluv $model
         */
        $model = $this->beluvFactory->create();
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            $id = $data['beluv_id'] ? $data['beluv_id'] : null;
            $id == null ? $msg = __('add record success') : $msg = __('Edit record success');
            if (isset($data['beluv_id']) && !$id) {
                unset($data['beluv_id']);
            }
            if ($id) {
                $model->load($id);
                $model->addData([
                    "beluv_id" => (int)$data['beluv_id'],
                    "condition_id" => (int)$data['condition_id'],
                    "sub_id" => (int)$data['sub_id'],
                    "type" => (int)$data['type'],
                    "title" => $data['title'],
                    "description" => $data['description'],
                ]);
                $model->save();
            }
            {
                $model->addData([
                    "condition_id" => (int)$data['condition_id'],
                    "sub_id" => (int)$data['sub_id'],
                    "type" => (int)$data['type'],
                    "title" => $data['title'],
                    "description" => $data['description'],
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
            return $resultRedirect->setPath('*/*/edit', ['beluv_id' => $id, 'duplicate' => '0']);
        }
        {
            return $resultRedirect->setPath('*/*/index');
        }
    }
}
