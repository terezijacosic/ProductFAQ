<?php

namespace Inchoo\ProductFAQ\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface FaqsSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get faqs list.
     *
     * @return \Inchoo\ProductFAQ\Api\Data\FaqsInterface[]
     */
    public function getItems();

    /**
     * Set faqs list.
     *
     * @param \Inchoo\ProductFAQ\Api\Data\FaqsInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
