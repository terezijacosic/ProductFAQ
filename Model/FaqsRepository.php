<?php

namespace Inchoo\ProductFAQ\Model;

use Inchoo\ProductFAQ\Api\Data;
use Inchoo\ProductFAQ\Api\Data\FaqsInterface;
use Inchoo\ProductFAQ\Api\FaqsRepositoryInterface;
use Inchoo\ProductFAQ\Api\Data\FaqsSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;

class FaqsRepository implements FaqsRepositoryInterface
{
    /**
     * @var \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory
     */
    protected $faqModelFactory;

    /**
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs
     */
    protected $faqResource;

    /**
     * @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * @var \Inchoo\ProductFAQ\Api\Data\FaqsSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;


    public function __construct(
        \Inchoo\ProductFAQ\Api\Data\FaqsInterfaceFactory $faqModelFactory,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs $faqResource,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $faqCollectionFactory,
        \Inchoo\ProductFAQ\Api\Data\FaqsSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->faqModelFactory = $faqModelFactory;
        $this->faqResource = $faqResource;
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param int $faqId
     * @return FaqsInterface
     * @throws NoSuchEntityException
     */
    public function getById($faqId)
    {
        $faq = $this->faqModelFactory->create();
        $this->faqResource->load($faq, $faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('Faqs with id "%1" does not exist.', $faqId));
        }
        return $faq;
    }

    /**
     * @param FaqsInterface $faq
     * @return FaqsInterface
     * @throws CouldNotSaveException
     */
    public function save(FaqsInterface $faq)
    {
        try {
            $this->faqResource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $faq;
    }

    /**
     * @param FaqsInterface $faq
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(FaqsInterface $faq)
    {
        // TODO: Implement delete() method.
        try {
            $this->faqResource->delete($faq);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        return true;
    }

    /**
     * @param FaqsInterface $faq
     * @return mixed|void
     */
    public function updateVisible(FaqsInterface $faq)
    {
        $faq->setIsVisible(1);
        $this->save($faq);
    }

     /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return FaqsSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        /** @var \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\Collection $collection */
        $collection = $this->faqCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var FaqsSearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

}