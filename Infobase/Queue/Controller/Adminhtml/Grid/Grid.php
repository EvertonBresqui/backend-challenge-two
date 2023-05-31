<?php
namespace Infobase\Queue\Controller\Adminhtml\Grid;

class Grid extends \Magento\Backend\App\Action
{
    protected $_resultRawFactory;
    protected $_layoutFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory
    ) {
        parent::__construct($context);
        $this->_resultRawFactory = $resultRawFactory;
        $this->_layoutFactory = $layoutFactory;
    }

    public function execute()
    {
        $resultRaw = $this->_resultRawFactory->create();
        $html = $this->_layoutFactory->create()->createBlock(
            'Infobase\Queue\Block\Adminhtml\Grid\Grid',
            'grid.view.grid'
        )->toHtml();
        return $resultRaw->setContents($html);
    }
}