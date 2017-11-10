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
 * Product Review Tab
 *
 * @api
 * @author     Magento Core Team <core@magentocommerce.com>
 * @since 100.0.2
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
     * Review resource model
     *
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory
     */
    protected $_collection;

    protected $_currentCustomer;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_collection = $collectionFactory;
        $this->_currentCustomer = $currentCustomer;
        parent::__construct($context, $data);

        $this->setTabTitle();
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

    public function getCustomerId()
    {
        $customerId = $this->_currentCustomer->getCustomerId();
        if (!$customerId) {
            return false;
        }
        return $customerId;
    }


    public function getAction()
    {
        return $this->getUrl(
            'productfaq/product/post',
            [
                '_secure' => $this->getRequest()->isSecure(),
                'product_id' => $this->getProductId(),
                'customer_id' => $this->getCustomerId()
            ]
        );
    }


    /**
     * Set tab title
     *
     * @return void
     */
    public function setTabTitle()
    {
        $title = $this->getCollectionSize()
            ? __('FAQ %1', '<span class="counter">' . $this->getCollectionSize() . '</span>')
            : __('FAQ');
        $this->setTitle($title);
    }

    /**
     * Get size of reviews collection
     *
     * @return int
     */
    public function getCollectionSize()
    {
        $collection = $this->_collection->create()
        ->addProductFilter(
            $this->getProductId()
        );

        return $collection->getSize();
    }

    public function dateFormat($date)
    {
        return $this->formatDate($date, \IntlDateFormatter::SHORT);
    }

    public function getQuestions()
    {
        $productId = $this->getProductId();
        if (!$productId) {
            return false;
        }
        $result =  $this->_collection->create();
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