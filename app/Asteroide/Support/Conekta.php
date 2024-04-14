<?php

namespace App\Asteroide\Support;

class Conekta
{
    public $provider;

    public $items;

    public $customer;

    public $currency;

    public $order;

    public $id;

    public $reference;

    public $expiresAt;

    public $shippingOption;

    public function __construct($items, $customer, $currency, $shippingOption)
    {
        \Conekta\Conekta::setApiKey(config('asteroide.payments.conekta.secret'));
        \Conekta\Conekta::setApiVersion('2.0.0');
        \Conekta\Conekta::setLocale('es');

        $this->items = $items;
        $this->customer = $customer;
        $this->currency = $currency;
        $this->shippingOption = $shippingOption;
    }

    public function orderArray()
    {
        $timeZone = Localization::getUserTimeZone();
        $this->expiresAt = now()->addDays(30);

        return [
            'line_items' => $this->items,
            'shipping_lines' => [
                $this->shippingOption,
            ],
            'currency' => $this->currency,
            'customer_info' => [
                'name' => 'Fulanito Pérez',
                'email' => 'fulanito@conekta.com',
                'phone' => '+5218181818181',
            ],
            'shipping_contact' => [
                'address' => [
                    'street1' => 'Calle 123, int 2',
                    'postal_code' => '06100',
                    'country' => 'MX',
                ],
            ],
            'charges' => [
                [
                    'payment_method' => [
                        'type' => 'oxxo_cash',
                        'expires_at' => $this->expiresAt->setTimeZone($timeZone)->getTimestamp(),
                    ],
                ],
            ],
        ];
    }

    public static function createOrder($items, $customer, $currency, $shippingOption)
    {
        $conekta = new Conekta($items, $customer, $currency, $shippingOption);
        $conekta->order = \Conekta\Order::create($conekta->orderArray());
        $conekta->id = optional($conekta->order)->id;
        $conekta->reference = optional(optional(optional($conekta->order)->charges[0])->payment_method)->reference;

        return $conekta;
    }
}
