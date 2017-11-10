<?php

namespace Inchoo\ProductFAQ\Block;

use Inchoo\ProductFAQ\Api\Data\FaqsInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SortOrderBuilder;
use Magento\Customer\Api\AccountManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;

class QuestionsBlock extends \Magento\Customer\Block\Account\Dashboard
{
    /**
     * Product questions collection
     *
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\Collection
     */
    protected $_collection;

    /**
     * Question resource model
     *
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $currentCustomer;

    protected $faqsRepository;
//    protected $faqsModelFactory;
    protected $filterBuilder;
    protected $searchCriteriaBuilder;
    protected $sortOrderBuilder;

    /**
     * @param \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder,
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
     * @param \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param AccountManagementInterface $customerAccountManagement
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param array $data
     */
    public function __construct(
        \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository,
        FilterBuilder $filterBuilder,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        SortOrderBuilder $sortOrderBuilder,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        CustomerRepositoryInterface $customerRepository,
        AccountManagementInterface $customerAccountManagement,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->faqsRepository = $faqsRepository;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct(
            $context,
            $customerSession,
            $subscriberFactory,
            $customerRepository,
            $customerAccountManagement,
            $data
        );
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * Get html code for toolbar
     *
     * @return string
     */
    public function getToolbarHtml()
    {
        return $this->getChildHtml('toolbar');
    }

    /**
     * Initializes toolbar
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _prepareLayout()
    {
//        var_dump($this->debug($this->getQuestions()));
        if ($this->getQuestions()) {
            $toolbar = $this->getLayout()->createBlock(
                \Magento\Theme\Block\Html\Pager::class,
                'customer_question_list.toolbar'
            );
            $toolbar->setCollection($this->_collection);
            $this->setChild('toolbar', $toolbar);
        }
        return parent::_prepareLayout();
    }

    /**
     * Get questions
     *
     */
    public function getQuestions()
    {
        $customerId = $this->currentCustomer->getCustomerId();
        if (!$customerId) {
            return false;
        }
        if (!$this->_collection) {
            $this->_collection = $this->_collectionFactory->create();
            $this->_collection
                ->addCustomerFilter($customerId)
                ->setDateOrder();
        }
        return $this->_collection;
    }



    /**
     * Get question link
     *
     * @return string
     * @deprecated 100.2.0
     */
    public function getQuestionLink()
    {
        return $this->getUrl('question/customer/view/');
    }

    /**
     * Get question URL
     *
     * @param \Inchoo\ProductFAQ\Model\Faqs $question
     * @return string
     * @since 100.2.0
     */
    public function getQuestionUrl($question)
    {
        return $this->getUrl('question/customer/view', ['id' => $question->getId()]);
    }

    /**
     * Get product link
     *
     * @return string
     * @deprecated 100.2.0
     */
    public function getProductLink()
    {
        return $this->getUrl('catalog/product/view/');
    }

    /**
     * Get product URL
     *
     * @param \Inchoo\ProductFAQ\Model\Faqs $question
     * @return string
     * @since 100.2.0
     */
    public function getProductUrl($question)
    {
        return $this->getUrl('catalog/product/view', ['id' => $question->getProductId()]);
    }

    /**
     * Format date in short format
     *
     * @param string $date
     * @return string
     */
    public function dateFormat($date)
    {
        return $this->formatDate($date, \IntlDateFormatter::SHORT);
    }

    /**
     * Add question summary
     *
     * @return \Magento\Framework\View\Element\AbstractBlock
     */
    protected function _beforeToHtml()
    {
        return parent::_beforeToHtml();
    }
}
