<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/13/17
 * Time: 3:35 PM
 */

namespace Inchoo\ProductFAQ\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class ProductName extends Column
{
    /**
     * @var \Magento\Catalog\Model\ProductRepository
     */
    protected $productRepository;

    /**
     * @var \Magento\Customer\Model\Customer
     */
    protected $customer;

    /**
     * ProductName constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     * @param \Magento\Catalog\Model\ProductRepository $productRepository
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = [],
        \Magento\Catalog\Model\ProductRepository $productRepository,
        \Magento\Customer\Model\Customer $customer
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->productRepository = $productRepository;
        $this->customer = $customer;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProductById($id)
    {
        return $this->productRepository->getById($id);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }

        foreach ($dataSource['data']['items'] as & $item) {
            if (isset($item['faq_id'])) {
                $_product = $this->getProductById($item['product_id']);
                $item['product_name'] = $_product->getName();

                $_customer = $this->customer->load($item['customer_id']);
                $item['customer_name'] = $_customer->getName();
            }
        }

        return $dataSource;
    }

}