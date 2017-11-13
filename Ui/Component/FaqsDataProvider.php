<?php

namespace Inchoo\ProductFAQ\Ui\Component;

class FaqsDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * FaqsDataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        if ($this->getName() == 'faqs_form_data_source') {

            $dataObject = $this->getCollection()->getFirstItem();

            $data = [
                $dataObject->getId() => $dataObject->toArray()
            ];

        } else {
            $data = $this->getCollection()->toArray();
        }

        return $data;
    }

}