<?php
namespace NiceForNow\HairCare\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\View\Result\PageFactory;
class index extends Action
{
    protected $_dataPersistor;
    protected $_pageFactory;
    public function __construct(
        Context $context,
        DataPersistorInterface $dataPersistor,
        PageFactory $pageFactory
    ) {
        $this->_dataPersistor = $dataPersistor;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }
    public function execute()
    {
        $post = $this->getRequest()->getPost();
        $postArray = [
            "condition1" => $post["condition1"],
            "condition2" => $post["condition2"]
        ];
        $this->_dataPersistor->set('condition', $postArray);
        return $this->_pageFactory->create();
    }
}