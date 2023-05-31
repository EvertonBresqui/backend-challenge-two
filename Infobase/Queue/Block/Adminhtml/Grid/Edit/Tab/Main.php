<?php
namespace Infobase\Queue\Block\Adminhtml\Grid\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{

    protected $_coreRegistry = null;
    protected $_adminSession;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Backend\Model\Auth\Session $adminSession,
        array $data = []
    ) {
        $this->_adminSession = $adminSession;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('infobase_queue_form_data');
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('page_');
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Manage Queue')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        
        $isElementDisabled = false;

        $fieldset->addField(
            'microservice_code',
            'text',
            [
                'name' => 'microservice_code',
                'label' => __('Microservice Code'),
                'title' => __('Microservice Code'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );

        $fieldset->addField(
            'microservice_endpoint',
            'text',
            [
                'name' => 'microservice_endpoint',
                'label' => __('Microservice Endpoint'),
                'title' => __('Microservice Endpoint'),
                'required' => true,
                'disabled' => $isElementDisabled,
            ]
        );

        $form->addValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

    public function getTabLabel()
    {
        return __('Manage Queue');
    }

    public function getTabTitle()
    {
        return __('Manage Queue');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
    
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}