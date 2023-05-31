<?php
namespace Infobase\Queue\Controller\Adminhtml\Grid;

class Save extends \Magento\Backend\App\Action
{

    protected $_adminSession;
    protected $_queueFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Backend\Model\Auth\Session $adminSession,
        \Infobase\Queue\Model\QueueFactory $queueFactory
    ) {
        parent::__construct($context);
        $this->_adminSession = $adminSession;
        $this->_queueFactory = $queueFactory;
    }

    public function execute()
    {
        $postObj = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();

        if (count($postObj) > 0) {
            $model = $this->_queueFactory->create();
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $postObj['updated_at'] = date('Y-m-d');
            }
            else{
                $postObj['created_at'] = date('Y-m-d');
            }

            $model->setData($postObj);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->_adminSession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}