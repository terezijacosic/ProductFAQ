<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/7/17
 * Time: 9:23 AM
 */

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faqs;

use Magento\Backend\App\Action;

class Visible extends \Magento\Backend\App\Action
{
    protected $faqsRepository;
    protected $faqsResource;
    protected $faqsFactory;
    protected $request;

    public function __construct(
        Action\Context $context,
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs $faqsResource,
        \Inchoo\ProductFAQ\Model\FaqsFactory $faqsFactory,
        \Magento\Framework\App\Request\Http $request
    )
    {
        parent::__construct($context);

        $this->faqsRepository = $faqsRepository;
        $this->faqsResource = $faqsResource;
        $this->faqsFactory = $faqsFactory;
        $this->request = $request;
    }

    public function execute()
    {
        $id = $this->request->getParam('faq_id');

        $faqs = $this->faqsRepository->getById($id);
        $this->faqsRepository->updateVisible($faqs);
//        $faqs = $this->faqsFactory->create();
//        $this->faqsResource->load($faqs, $id);
//        $faqs->setIsVisible(1);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('productfaq/faqs/index');
        return $resultRedirect;
    }
}