<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace NiceForNow\HairCare\Block\Adminhtml\SubCondition\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use NiceForNow\HairCare\Block\Adminhtml\SubCondition\Edit\GenericButton;
/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var string
     */
    protected $idName = 'sub_id';
    /**
     * @inheritDoc
     */

    public function getButtonData()
    {
        $data = [];
        if ($this->getId()) {
            $data = [
                'label' => __('Delete Condition'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['sub_id'=> $this->getId()]);
    }

}
