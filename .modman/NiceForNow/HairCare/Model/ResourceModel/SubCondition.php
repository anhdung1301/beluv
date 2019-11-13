<?php
namespace  NiceForNow\HairCare\Model\ResourceModel;

class SubCondition extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('custom_sub_condition', 'sub_id');
    }

}