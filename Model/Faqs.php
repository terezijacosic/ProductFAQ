<?php

namespace Inchoo\ProductFAQ\Model;

use Magento\Framework\Model\AbstractModel;
use Inchoo\ProductFAQ\Api\Data\FaqsInterface;

class Faqs extends AbstractModel implements FaqsInterface
{

    /**
     * Cache tag
     */
    const CACHE_TAG = 'faqs_block';
    /**
     * Initialize faqs Model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Inchoo\ProductFAQ\Model\ResourceModel\Faqs::class);
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * Retrieve block question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }
    
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }
    
    public function getIsVisible()
    {
        return $this->getData(self::IS_VISIBLE);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

   
    
    /*******************************************/

    /**
     * Set ID
     *
     * @param int $id
     * @return FaqsInterface
     */
    public function setId($id)
    {
        return $this->setData(self::FAQ_ID, $id);
    }

    /**
     * Set question
     *
     * @param string $question
     * @return FaqsInterface
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    public function setIsVisible($visible)
    {
        return $this->setData(self::IS_VISIBLE , $visible);
    }

    public function setCreatedAt($timestampCreated)
    {
        return $this->setData(self::CREATED_AT, $timestampCreated);
    }

    public function setUpdatedAt($timestampUpdated)
    {
        return $this->setData(self::UPDATED_AT, $timestampUpdated);
    }



}