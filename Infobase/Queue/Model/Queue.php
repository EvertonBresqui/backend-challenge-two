<?php

namespace Infobase\Queue\Model;

class Queue extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Infobase\Queue\Model\ResourceModel\Queue');
    }

}
