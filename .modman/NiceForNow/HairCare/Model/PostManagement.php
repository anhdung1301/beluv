<?php
namespace  NiceForNow\HairCare\Model;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;
use Magento\Framework\App\ResourceConnection;


class PostManagement
{

    protected $pageLayoutBuilder;
    protected $_resourceConnection;
    protected $options;
    protected $request;

    public function __construct(BuilderInterface $pageLayoutBuilder,ResourceConnection $resourceConnection,
                                \Magento\Framework\App\Request\Http $request)
    {
        $this->pageLayoutBuilder = $pageLayoutBuilder;
        $this->_resourceConnection = $resourceConnection;
        $this->request = $request;
    }
    public function getSubCondition()
    {
        $this->request->getParams();
        $connection = $this->_resourceConnection->getConnection();
        $select = $connection->select()
            ->from(
                ['ce' => 'custom_sub_condition']
            )
            ->where('condition_id = ?', 1);
        $data = $connection->fetchAll($select);
        return $data;

    }

}
