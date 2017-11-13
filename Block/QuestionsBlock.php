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

    /**
     * @var \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface
     */
    protected $faqsRepository;

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var SortOrderBuilder
     */
    protected $sortOrderBuilder;

    /**
     * @param \Inchoo\ProductFAQ\Api\FaqsRepositoryInterface $faqsRepository ,
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder ,
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder ,
     * @param \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder ,
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
    )
    {
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
     * Get questions collection
     *
     * @return bool|\Inchoo\ProductFAQ\Model\ResourceModel\Faqs\Collection
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
        $array = $this->_collection->getItems();
        return  count($array) > 0 ? $this->_collection : false;
    }

    /**
     * Get product URL
     *
     * @param \Inchoo\ProductFAQ\Model\Faqs $question
     * @return string
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

}
