<?php

namespace NiceForNow\HairCare\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\Result\PageFactory;


class getajax extends Action
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var RawFactory
     */
    protected $resultRawFactory;

    /**
     * @param Context $context
     * @param PageFactory resultPageFactory
     * @param RawFactory $resultRawFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        RawFactory $resultRawFactory
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRawFactory = $resultRawFactory;
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
