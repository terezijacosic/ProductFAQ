<?php

namespace Inchoo\ProductFAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faqs extends AbstractDb
{
    /**
     * Initialize faqs Resource
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('inchoo_product_faqs', 'faq_id');
    }
}
