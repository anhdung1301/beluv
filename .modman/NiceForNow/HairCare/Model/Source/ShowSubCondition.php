<?php
namespace  NiceForNow\HairCare\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;
use Magento\Framework\App\ResourceConnection;

class ShowSubCondition implements OptionSourceInterface
{

    protected $pageLayoutBuilder;
    protected $_resourceConnection;
    protected $options;


    public function __construct(BuilderInterface $pageLayoutBuilder,ResourceConnection $resourceConnection)
    {
        $this->pageLayoutBuilder = $pageLayoutBuilder;
        $this->_resourceConnection = $resourceConnection;
    }


    public function toOptionArray()
    {

        $configOptions=$this->getSubCondition();
        $options = [];
        foreach ($configOptions as $key => $value) {
            $options[] = [
                'label' => $value["name"],
                'value' => $value["sub_id"],
            ];
        }
        $this->options = $options;

        return $options;
    }
    public function getSubCondition()
    {
        $connection = $this->_resourceConnection->getConnection();
        $select = $connection->select()
            ->from(
                ['ce' => 'custom_sub_condition']
            );
        $data = $connection->fetchAll($select);
        return $data;

    }

}