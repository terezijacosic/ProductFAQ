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
    /**
     * @var \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface
     */
    protected $faqsRepository;

    /**
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs
     */
    protected $faqsResource;

    /**
     * @var \Inchoo\ProductFAQ\Model\FaqsFactory
     */
    protected $faqsFactory;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * Visible constructor.
     * @param Action\Context $context
     * @param \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faqs $faqsResource
     * @param \Inchoo\ProductFAQ\Model\FaqsFactory $faqsFactory
     * @param \Magento\Framework\App\Request\Http $request
     */
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

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->request->getParam('faq_id');

        $faqs = $this->faqsRepository->getById($id);
        $this->faqsRepository->updateVisible($faqs);

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('productfaq/faqs/index');

        return $resultRedirect;
    }
}