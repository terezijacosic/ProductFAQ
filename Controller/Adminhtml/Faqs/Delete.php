<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/6/17
 * Time: 12:38 PM
 */

namespace Inchoo\ProductFAQ\Controller\Adminhtml\Faqs;

use Inchoo\ProductFAQ\Api\FaqsRepositoryInterface;
use Magento\Backend\App\Action;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var FaqsRepositoryInterface
     */
    protected $faqsRepository;

    /**
     * @var \Inchoo\ProductFAQ\Model\FaqsFactory
     */
    protected $faqsFactory;

    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    public function __construct(
        Action\Context $context,
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        \Inchoo\ProductFAQ\Model\FaqsFactory $faqsFactory,
        \Magento\Framework\App\Request\Http $request
    )
    {
        parent::__construct($context);

        $this->faqsRepository = $faqsRepository;
        $this->faqsFactory = $faqsFactory;
        $this->request = $request;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $id = $this->request->getParam('faq_id');

        try {
            $faq = $this->faqsRepository->getById($id);
            $this->faqsRepository->delete($faq);

        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong. :('));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('productfaq/faqs/index');

        return $resultRedirect;
    }
}