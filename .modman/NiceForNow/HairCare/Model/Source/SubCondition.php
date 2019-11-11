<?php
namespace  NiceForNow\HairCare\Model\Source;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Model\PageLayout\Config\BuilderInterface;
use Magento\Framework\App\ResourceConnection;
class SubCondition implements OptionSourceInterface
{
    protected $pageLayoutBuilder;
    protected $_resourceConnection;
    protected $options;
    protected $_dataPersistor;
    public function __construct(BuilderInterface $pageLayoutBuilder,ResourceConnection $resourceConnection,
                                DataPersistorInterface $dataPersistor)
    {
        $this->pageLayoutBuilder = $pageLayoutBuilder;
        $this->_resourceConnection = $resourceConnection;
        $this->_dataPersistor = $dataPersistor;
    }
    public function toOptionArray()
    {
        $id = $this->_dataPersistor->get('id_sub');

        $configOptions=$this->getSubCondition($id);
        $options = [];
        foreach ($configOptions as $key => $value) {
            $options[] = [
                'label' => $value["name"],
                'value' => $value["sub_id"],
            ];
        }
        $this->_dataPersistor->clear('id_sub');
        $this->options = $options;
        return $options;
    }
    public function getSubCondition($subCondition)
    {
        $connection = $this->_resourceConnection->getConnection();
        $select = $connection->select()
            ->from(
                ['ce' => 'custom_sub_condition']
            )
            ->where('condition_id = ?', $subCondition);
        $data = $connection->fetchAll($select);
        return $data;

    }
}