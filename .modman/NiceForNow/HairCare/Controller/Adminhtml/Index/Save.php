<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 3/22/19
 * Time: 5:24 PM
 */
namespace NiceFornow\HairCare\Controller\Adminhtml\Index;

use NiceFornow\HairCare\Model\BeluvFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Save extends Action
{
    protected $postFactory;
    public function __construct(
        Context $context,
        BeluvFactory $postFactory
    ) {
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $data = $this->getRequest()->getPost('post');
        var_dump($data);die;
        $post = $this->postFactory->create()->load($data['id']);
        $post->setData('content', $data['content']);
        $post->setData('status', $data['status']);
        $post->save();
        return $this->_redirect('*/*/index');
    }
}
