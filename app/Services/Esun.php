<?php

namespace App\Services;

class Esun
{
    public static function send($data)
    {
        return view('payment.esun', [
            'TA' => $data['amount'],
            'ONO' => $data['orderNumber']
        ]);
    }
}
