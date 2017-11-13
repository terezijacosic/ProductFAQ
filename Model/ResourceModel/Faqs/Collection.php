<?php

namespace Inchoo\ProductFAQ\Model\ResourceModel\Faqs;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Initialize Faqs collection
     */
    protected function _construct()
    {
        $this->_init(
            \Inchoo\ProductFAQ\Model\Faqs::class,
            \Inchoo\ProductFAQ\Model\ResourceModel\Faqs::class
        );
    }

    /**
     * @param $customerId
     * @return $this
     */
    public function addCustomerFilter($customerId)
    {
        $this->getSelect()->where('customer_id = ?', $customerId);
        return $this;
    }

    /**
     * @param $productId
     * @return $this
     */
    public function addProductFilter($productId)
    {
        $this->getSelect()->where('product_id = ?', $productId);
        return $this;
    }

    /**
     * @return $this
     */
    public function addVisibleFilter()
    {
        $this->getSelect()->where('is_visible > ?', 0);
        return $this;
    }

    /**
     * @param string $dir
     * @return $this
     */
    public function setDateOrder($dir = 'DESC')
    {
        $this->setOrder('created_at', $dir);
        return $this;
    }
}
