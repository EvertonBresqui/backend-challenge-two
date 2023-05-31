<?php
namespace Infobase\Queue\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    const SETTINGS_GENERAL  = 'infobase_queue/general/';

    public function __construct(
        \Magento\Framework\App\Helper\Context $context
    ) {
        parent::__construct($context);
    }

    public function getSettingsGeneral($configNode)
    {
        return $this->scopeConfig->getValue(
            self::SETTINGS_GENERAL . $configNode,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
}
