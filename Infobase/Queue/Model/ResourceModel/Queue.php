<?php
namespace Infobase\Queue\Model\ResourceModel;

class Queue extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('infobase_queue', 'id');
    }
}
