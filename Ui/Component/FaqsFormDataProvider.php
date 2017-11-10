<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/6/17
 * Time: 1:37 PM
 */

namespace Inchoo\ProductFAQ\Ui\Component;


class FaqsFormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
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
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $collectionFactory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        return $data = $this->getCollection()->toArray();

    }

}