<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/9/17
 * Time: 1:43 PM
 */

namespace Inchoo\ProductFAQ\Controller\Product;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface
     */
    protected $faqsRepository;

    /**
     * @var \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory
     */
    protected $faqsModelFactory;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Post constructor.
     * @param Context $context
     * @param \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository
     * @param \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqsModelFactory
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    public function __construct(
        Context $context,
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqsModelFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Store\Model\StoreManagerInterface $storeManager
    )
    {
        parent::__construct($context);
        $this->faqsRepository = $faqsRepository;
        $this->faqsModelFactory = $faqsModelFactory;
        $this->request = $request;
        $this->currentCustomer = $currentCustomer;
        $this->customerSession = $customerSession;
        $this->storeManager = $storeManager;
    }

    /**
     * Check customer authentication
     *
     * @param RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     */
    public function dispatch(RequestInterface $request)
    {
        if (!$this->customerSession->authenticate()) {
            $this->_actionFlag->set('', self::FLAG_NO_DISPATCH, true);
        }
        return parent::dispatch($request);
    }

    /**
     * Controller action
     */
    public function execute()
    {
        $question = $this->request->getParam('question');
        $productId = $this->request->getParam('product_id');
        $customerId = $this->currentCustomer->getCustomerId();
        $storeId = $this->storeManager->getStore()->getId();

        if (!$customerId) {
            $this->_redirect('catalog/product/view/id/' . $productId);
        }

        try {
            $faqs = $this->faqsModelFactory->create();
            $faqs->setQuestion($question);
            $faqs->setProductId($productId);
            $faqs->setCustomerId($customerId);
            $faqs->setStoreId($storeId);

            $this->faqsRepository->save($faqs);
            $this->messageManager->addSuccessMessage(__('You submitted your question for moderation.'));
        } catch (CouldNotSaveException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong. :('));
        }

        $this->_redirect('catalog/product/view/id/' . $productId);
    }
}