<?php

namespace Inchoo\ProductFAQ\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class EditActions
 */
class Actions extends Column
{
    /**
     * Prepare Data Source
     *
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
                $item[$name]['edit'] = [
                    'href' => $this->context->getUrl('productfaq/faqs/edit', ['faq_id' => $item['faq_id']]),
                    'label' => __('Edit')
                ];
                $item[$name]['delete'] = [
                    'href' => $this->context->getUrl('productfaq/faqs/delete', ['faq_id' => $item['faq_id']]),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete ${ $.$data.question }'),
                        'message' => __('Are you sure you wan\'t to delete a ${ $.$data.question }?')
                    ]
                ];
                $item[$name]['visible'] = [
                    'href' => $this->context->getUrl('productfaq/faqs/visible', ['faq_id' => $item['faq_id']]),
                    'label' => __('Set Visible On Frontend')
                ];
            }
        }

        return $dataSource;
    }
}
