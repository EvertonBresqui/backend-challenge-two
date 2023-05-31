<?php
namespace Infobase\Queue\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class MassDelete extends \Magento\Backend\App\Action
{

    protected $_collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Infobase\Queue\Model\ResourceModel\Queue\CollectionFactory $collectionFactory
    ) {
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute()
    {

        $deleteIds = $this->getRequest()->getPost('id');
        $collection = $this->_collectionFactory->create();
        $collection->addFieldToFilter('id', ['in' => $deleteIds]);
        $delete = 0;

        foreach ($collection as $item) {
            $item->delete();
            $delete++;
        }

        $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $delete));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}