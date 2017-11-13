<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/2/17
 * Time: 2:07 PM
 */

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faqs;

use Inchoo\ProductFAQ\Api\FaqsRepositoryInterface;
use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Inchoo\ProductFAQ\Model\FaqsFactory
     */
    protected $faqsFactory;

    /**
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs
     */
    protected $faqsResource;

    /**
     * @var FaqsRepositoryInterface
     */
    protected $faqsRepository;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * Save constructor.
     * @param Action\Context $context
     * @param \Inchoo\ProductFAQ\Model\FaqsFactory $faqsFactory
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faqs $faqsResource
     * @param FaqsRepositoryInterface $faqsRepository
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        Action\Context $context,
        \Inchoo\ProductFAQ\Model\FaqsFactory $faqsFactory,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs $faqsResource,
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        \Magento\Framework\App\Request\Http $request
    )
    {
        parent::__construct($context);

        $this->faqsFactory = $faqsFactory;
        $this->faqsResource = $faqsResource;
        $this->faqsRepository = $faqsRepository;
        $this->request = $request;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->request->getParam('faq_id');
        $question = $this->request->getParam('question');
        $answer = $this->request->getParam('answer');
        $productId = $this->request->getParam('product_id');
        $visible = $this->request->getParam('is_visible');

        $faqs = $this->faqsFactory->create();
        $faqs->setId($id);
        $faqs->setQuestion($question);
        $faqs->setAnswer($answer);
        $faqs->setProductId($productId);
        $faqs->setIsVisible($visible);
        $this->faqsResource->save($faqs);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('productfaq/faqs/index');

        return $resultRedirect;
    }
}