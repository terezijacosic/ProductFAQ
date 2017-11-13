<?php

namespace Inchoo\ProductFAQ\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqsRepositoryInterface
{
    /**
     * Retrieve faqs.
     *
     * @param int $faqsId
     * @return \Inchoo\ProductFAQ\Api\Data\FaqsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($faqsId);

    /**
     * Save faqs.
     *
     * @param \Inchoo\ProductFAQ\Api\Data\FaqsInterface $faqs
     * @return \Inchoo\ProductFAQ\Api\Data\FaqsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\FaqsInterface $faqs);

    /**
     * Delete faqs.
     *
     * @param \Inchoo\ProductFAQ\Api\Data\FaqsInterface $faqs
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\FaqsInterface $faqs);

    /**
     * Update visibility on frontend.
     *
     * @param Data\FaqsInterface $faqs
     * @return mixed
     */
    public function updateVisible(Data\FaqsInterface $faqs);

    /**
     * Retrieve faqs matching the specified search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Inchoo\ProductFAQ\Api\Data\FaqsSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

}
