<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/7/17
 * Time: 12:29 PM
 */

namespace Inchoo\ProductFAQ\Controller\Index;

use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Helper\Session\CurrentCustomer;
use Magento\Framework\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_currentCustomer;

    public function __construct(
        Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
    )
    {
        parent::__construct($context);
        $this->_currentCustomer = $currentCustomer;
    }

    public function execute()
    {
        $customerId = $this->_currentCustomer->getCustomerId();

        if (!$customerId) {
            $this->_redirect('/');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if ($navigationBlock = $resultPage->getLayout()->getBlock('customer_account_navigation')) {
            $navigationBlock->setActive('productfaq/index');
        }
        if ($block = $resultPage->getLayout()->getBlock('customer_product_questions')) {
            $block->setRefererUrl($this->_redirect->getRefererUrl());
        }
        $resultPage->getConfig()->getTitle()->set(__('My Product Questions'));
        return $resultPage;
    }
}