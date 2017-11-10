<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/9/17
 * Time: 1:43 PM
 */

namespace Inchoo\ProductFAQ\Controller\Product;

use Magento\Framework\App\Action\Context;
use \Magento\Framework\Controller\ResultFactory;

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

    protected $request;
    /**
     * Crud constructor.
     *
     * @param Context $context
     * @param \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository
     * @param \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqsModelFactory
     */
    public function __construct(
        Context $context,
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqsModelFactory,
        \Magento\Framework\App\Request\Http $request
    ) {
        parent::__construct($context);
        $this->faqsRepository = $faqsRepository;
        $this->faqsModelFactory = $faqsModelFactory;
        $this->request = $request;
    }

    /**
     * Controller action.
     */
    public function execute()
    {
        $question = $this->request->getParam('question');
        $productId = $this->request->getParam('product_id');
        $customerId = $this->request->getParam('customer_id');

        try {
            $faqs = $this->faqsModelFactory->create();
            $faqs->setQuestion($question);
            $faqs->setProductId($productId);
            $faqs->setCustomerId($customerId);

            $this->faqsRepository->save($faqs);
//            var_dump($faqs->debug()); poruka success!
            $this->messageManager->addSuccessMessage(__('You submitted your question for moderation.'));
        } catch (CouldNotSaveException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong. :('));
//            var_dump($e);
        }

        $this->_redirect('catalog/product/view/id/' . $productId);
    }

}