<?php
namespace Infobase\Queue\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $_coreRegistry = null;
    protected $_adminSession;
    protected $_queueFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\Session $adminSession,
        \Infobase\Queue\Model\QueueFactory $queueFactory
    ) {
        $this->_coreRegistry = $registry;
        $this->_adminSession = $adminSession;
        $this->_queueFactory = $queueFactory;
        parent::__construct($context);
    }

    protected function _isAllowed()
    {
        return true;
    }

    protected function _initAction()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Infobase_Queue::infobase')->addBreadcrumb(__('Queue'), __('Queue'))->addBreadcrumb(__('Manage Queue'), __('Manage Queue'));
        return $resultPage;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_queueFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This queue record no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $data = $this->_adminSession->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('infobase_queue_form_data', $model);

        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb($id ? __('Edit Queue') : __('New Queue'), $id ? __('Edit Queue') : __('New Queue'));
        $resultPage->getConfig()->getTitle()->prepend(__('Grids'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Queue'));

        return $resultPage;
    }
}