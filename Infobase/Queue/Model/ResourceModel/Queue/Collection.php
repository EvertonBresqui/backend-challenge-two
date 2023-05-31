<?php
namespace Infobase\Queue\Model\ResourceModel\Queue;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            'Infobase\Queue\Model\Queue',
            'Infobase\Queue\Model\ResourceModel\Queue'
        );
    }
}
