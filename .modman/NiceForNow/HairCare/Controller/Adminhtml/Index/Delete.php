<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\HairCare\Controller\Adminhtml\Index;

use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \NiceForNow\HairCare\Controller\Adminhtml\Beluv implements HttpPostActionInterface
{

    public function execute()
    {

        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('beluv_id');

        if ($id) {
            try {

                // init model and delete
                $model = $this->_objectManager->create(\NiceForNow\HairCare\Model\Beluv::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the condition.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['beluv_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a block to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/index');
    }
}
