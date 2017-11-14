<?php

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faqs;

use Magento\Framework\Controller\ResultFactory;

class Edit extends \Magento\Cms\Controller\Adminhtml\Block
{

    /**
     * Edit Faqs action.
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Inchoo_ProductFAQ::faqs');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Faqs'));

        return $resultPage;
    }
}
