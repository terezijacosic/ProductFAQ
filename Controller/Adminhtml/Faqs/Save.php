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
use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $faqsFactory;
    protected $faqsResource;
    protected $faqsRepository;
    protected $request;

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

    public function execute()
    {
        $id = $this->request->getParam('faq_id');
        $question = $this->request->getParam('question');
        $answer = $this->request->getParam('answer');
        $productId = $this->request->getParam('product_id');
        $visible = $this->request->getParam('is_visible');
//        var_dump($visible);

        $faqs = $this->faqsFactory->create();
        $faqs->setId($id);
        $faqs->setQuestion($question);
        $faqs->setAnswer($answer);
        $faqs->setProductId($productId);
        $faqs->setIsVisible($visible);

//        $this->faqsRepository->save($faqs);

        $this->faqsResource->save($faqs);

//        var_dump('SAVED CHANGES :P');
//        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('productfaq/faqs/index');
        return $resultRedirect;
    }
}