<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class getajax extends Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory resultPageFactory
     * @param \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    )
    {
        $this->resultPageFactory    = $resultPageFactory;
        $this->resultRawFactory     = $resultRawFactory;
        parent::__construct($context);
    }
    /**
     * Example for returning Raw Text data
     *
     * @return string
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $result = $this->resultRawFactory->create();
        $block = $resultPage->getLayout()
            ->createBlock(
                "NiceForNow\HairCare\Block\Widget\SubCondition",
                "block_name",
                [
                    'data' => [
                        'my_arg' => 'testvalue'
                    ]
                ]
            )
            ->setData('area', 'frontend')
            ->toHtml();
        $result->setContents($block);
        return $result;
    }
}
