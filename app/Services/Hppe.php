<?php

namespace App\Services;

class Hppe
{
    public static function send($data)
    {
        return view('payment.hppe', [
            'order' => $data['order'],
            'TransAmt' => $data['amount'],
            'orderNumber' => $data['orderNumber']
        ]);
    }
}
