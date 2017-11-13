<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/9/17
 * Time: 1:43 PM
 */

namespace Inchoo\ProductFAQ\Controller\Product;

use Magento\Framework\App\Action\Context;

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
     * Post constructor.
     * @param Context $context
     * @param \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository
     * @param \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqsModelFactory
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     */
    public function __construct(
        Context $context,
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqsModelFactory,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
    )
    {
        parent::__construct($context);
        $this->faqsRepository = $faqsRepository;
        $this->faqsModelFactory = $faqsModelFactory;
        $this->request = $request;
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * Controller action
     */
    public function execute()
    {
        $question = $this->request->getParam('question');
        $productId = $this->request->getParam('product_id');
        $customerId = $this->currentCustomer->getCustomerId();

        if (!$customerId) {
            $this->_redirect('catalog/product/view/id/' . $productId);
        }

        try {
            $faqs = $this->faqsModelFactory->create();
            $faqs->setQuestion($question);
            $faqs->setProductId($productId);
            $faqs->setCustomerId($customerId);

            $this->faqsRepository->save($faqs);
            $this->messageManager->addSuccessMessage(__('You submitted your question for moderation.'));
        } catch (CouldNotSaveException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong. :('));
        }

        $this->_redirect('catalog/product/view/id/' . $productId);
    }
}