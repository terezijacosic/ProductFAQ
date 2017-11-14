<?php
/**
 * Created by PhpStorm.
 * User: terezija
 * Date: 11/14/17
 * Time: 2:06 PM
 */

namespace Inchoo\ProductFAQ\Model\Source;


class IsVisible implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Retrieve is_visible value
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => 'No'],
            ['value' => 1, 'label' => 'Yes']
        ];
    }

}