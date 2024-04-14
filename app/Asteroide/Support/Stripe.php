<?php

namespace App\Asteroide\Support;

use Illuminate\Support\Str;

class Stripe
{
    public $amount;

    public $currency;

    public $source;

    public $receiptEmail;

    public $description;

    public function __construct($amount, $currency, $source, $receiptEmail, $description)
    {
        $this->amount = $amount;
        $this->currency = $currency;
        $this->source = $source;
        $this->receiptEmail = $receiptEmail;
        $this->description = $description;

        \Stripe\Stripe::setApiKey(config('asteroide.payments.stripe.secret'));
    }

    public function orderArray()
    {
        return [
            'amount' => $this->amount * 100,
            'currency' => Str::lower($this->currency),
            'source' => $this->source,
            'receipt_email' => $this->receiptEmail,
            'description' => $this->description,
        ];
    }

    public function charge()
    {
        return \Stripe\Charge::create($this->orderArray());
    }

    public static function createOrder($amount, $currency, $source, $receiptEmail, $description)
    {
        $stripe = new Stripe($amount, $currency, $source, $receiptEmail, $description);

        return $stripe->charge();
    }
}
