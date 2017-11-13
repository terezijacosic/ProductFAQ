<?php

namespace Inchoo\ProductFAQ\Api\Data;

interface FaqsInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const FAQ_ID        = 'faq_id';
    const QUESTION      = 'question';
    const PRODUCT_ID    = 'product_id';
    const CUSTOMER_ID   = 'customer_id';
    const ANSWER        = 'answer';
    const IS_VISIBLE    = 'is_visible';
    const CREATED_AT    = 'created_at';
    const UPDATED_AT    = 'updated_at';
    /**#@-*/

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getQuestion();

    /**
     * @param $title
     * @return mixed
     */
    public function setQuestion($title);

    /**
     * @return mixed
     */
    public function getProductId();

    /**
     * @param $productId
     * @return mixed
     */
    public function setProductId($productId);

    /**
     * @return mixed
     */
    public function getCustomerId();

    /**
     * @param $customerId
     * @return mixed
     */
    public function setCustomerId($customerId);

    /**
     * @return mixed
     */
    public function getAnswer();

    /**
     * @param $answer
     * @return mixed
     */
    public function setAnswer($answer);

    /**
     * @return mixed
     */
    public function getIsVisible();

    /**
     * @param $visible
     * @return mixed
     */
    public function setIsVisible($visible);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $timestampCreated
     * @return mixed
     */
    public function setCreatedAt($timestampCreated);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param $timestampUpdated
     * @return mixed
     */
    public function setUpdatedAt($timestampUpdated);

}
