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

    public function getId();

    public function getQuestion();

    public function getProductId();

    public function getCustomerId();

    public function getAnswer();

    public function getIsVisible();

    public function getCreatedAt();

    public function getUpdatedAt();


    /******************/


    public function setId($id);

    public function setQuestion($title);

    public function setProductId($productId);

    public function setCustomerId($customerId);

    public function setAnswer($answer);

    public function setIsVisible($visible);

    public function setCreatedAt($timestampCreated);

    public function setUpdatedAt($timestampUpdated);

}
