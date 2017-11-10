<?php

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faqs;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Inchoo_ProductFAQ::faqs');
    }

    /**
     * Customer action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $resultPage->setActiveMenu('Inchoo_ProductFAQ::faqs');
        $resultPage->getConfig()->getTitle()->prepend(__('FAQ'));

        return $resultPage;
    }

}
