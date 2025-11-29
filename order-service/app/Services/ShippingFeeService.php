<?php

namespace App\Services;

class ShippingFeeService
{
    public function calculate($provinceCode)
    {
        $regions = config('regions');

        if (in_array($provinceCode, $regions['north'])) {
            return [
                'region' => 'north',
                'shipping_fee' => 0
            ];
        }

        if (in_array($provinceCode, $regions['central'])) {
            return [
                'region' => 'central',
                'shipping_fee' => 20000
            ];
        }

        if (in_array($provinceCode, $regions['south'])) {
            return [
                'region' => 'south',
                'shipping_fee' => 20000
            ];
        }

        return [
            'region' => 'unknown',
            'shipping_fee' => 20000
        ];
    }
}
