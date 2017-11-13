<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/8/17
 * Time: 3:16 PM
 */

namespace Inchoo\ProductFAQ\Block\Product;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;


/**
 * Product Questions Tab
 */
class ProductPageQuestions extends Template implements IdentityInterface
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * FAQ resource model
     *
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory
     */
    protected $_collection;

    /**
     * Currently logged customer
     *
     * @var \Magento\Customer\Helper\Session\CurrentCustomer
     */
    protected $_currentCustomer;

    /**
     * ProductPageQuestions constructor.
     * @param Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory
     * @param \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    )
    {
        $this->_coreRegistry = $registry;
        $this->_collection = $collectionFactory;
        $this->_currentCustomer = $currentCustomer;
        parent::__construct($context, $data);

    }

    /**
     * Get current product id
     *
     * @return null|int
     */
    public function getProductId()
    {
        $product = $this->_coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    /**
     * Check if customer is logged in
     *
     * @return bool|int|null
     */
    public function getCustomerId()
    {
        $customerId = $this->_currentCustomer->getCustomerId();
        if (!$customerId) {
            return false;
        }
        return $customerId;
    }

    /**
     * Send new FAQ data to controller
     *
     * @return string
     */
    public function getAction()
    {
        return $this->getUrl(
            'productfaq/product/post',
            [
                '_secure' => $this->getRequest()->isSecure(),
                'product_id' => $this->getProductId(),
            ]
        );
    }

    /**
     * Get only date from timestamp
     *
     * @param $date
     * @return string
     */
    public function dateFormat($date)
    {
        return $this->formatDate($date, \IntlDateFormatter::SHORT);
    }

    /**
     * Retrieve questions list for current product page
     *
     * @return bool|\Inchoo\ProductFAQ\Model\ResourceModel\Faqs\Collection
     */
    public function getQuestions()
    {
        $productId = $this->getProductId();
        if (!$productId) {
            return false;
        }
        $result = $this->_collection->create();
        $result->addProductFilter($productId)
            ->addVisibleFilter()
            ->setDateOrder();

        return $result;
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [\Inchoo\ProductFAQ\Model\Faqs::CACHE_TAG];
    }
}