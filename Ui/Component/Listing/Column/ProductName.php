<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/13/17
 * Time: 3:35 PM
 */

namespace Inchoo\ProductFAQ\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

class ProductName extends Column
{
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
                $name = $this->getData('name');
                $item[$name]['product_name'] = [
                    'label' => 'tmp'
                ];
            }
        }

        return $dataSource;
    }

}