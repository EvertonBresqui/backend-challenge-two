<?php
namespace Infobase\Queue\Controller\Adminhtml\Grid;

class Delete extends \Magento\Backend\App\Action
{
    protected $_queueFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Infobase\Queue\Model\QueueFactory $queueFactory
    ) {
        parent::__construct($context);
        $this->_queueFactory = $queueFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Infobase_Queue::infobase');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_queueFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('The queue has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/index', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a queue to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}