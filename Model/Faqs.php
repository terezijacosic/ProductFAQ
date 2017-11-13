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
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * @param int $id
     * @return FaqsInterface
     */
    public function setId($id)
    {
        return $this->setData(self::FAQ_ID, $id);
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * @param string $question
     * @return FaqsInterface
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @param $productId
     * @return $this
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * @param $answer
     * @return $this
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * @return mixed
     */
    public function getIsVisible()
    {
        return $this->getData(self::IS_VISIBLE);
    }

    /**
     * @param $visible
     * @return $this
     */
    public function setIsVisible($visible)
    {
        return $this->setData(self::IS_VISIBLE, $visible);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @param $timestampCreated
     * @return $this
     */
    public function setCreatedAt($timestampCreated)
    {
        return $this->setData(self::CREATED_AT, $timestampCreated);
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param $timestampUpdated
     * @return $this
     */
    public function setUpdatedAt($timestampUpdated)
    {
        return $this->setData(self::UPDATED_AT, $timestampUpdated);
    }
}