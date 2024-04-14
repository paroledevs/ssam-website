<?php

namespace App\Asteroide\Support;

use Illuminate\Support\Str;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PayPal
{
    public $response;

    public $reference;

    public $amount;

    public $currency;

    public $returnUrl;

    public $cancelUrl;

    public $approvalLink;

    public $id;

    public $payer;

    public $status;

    public function __construct($reference = null, $amount = null, $currency = null, $returnUrl = null, $cancelUrl = null)
    {
        $this->reference = $reference;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->returnUrl = $returnUrl;
        $this->cancelUrl = $cancelUrl;
    }

    public function onSandbox()
    {
        return config('paypal.mode') === 'sandbox';
    }

    public function environment()
    {
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.client_secret');

        return $this->onSandbox() ? new SandboxEnvironment($clientId, $clientSecret) : new ProductionEnvironment($clientId, $clientSecret);
    }

    public function client()
    {
        if ($this->onSandbox()) {
            ini_set('error_reporting', E_ALL);
            ini_set('display_errors', '1');
            ini_set('display_startup_errors', '1');
        }

        return new PayPalHttpClient($this->environment());
    }

    public function arrayTransaction()
    {
        return [
            'intent' => 'CAPTURE',
            'purchase_units' => [[
                'reference_id' => $this->reference,
                'amount' => [
                    'value' => "$this->amount",
                    'currency_code' => Str::upper($this->currency),
                ],
            ]],
            'application_context' => [
                'return_url' => $this->returnUrl,
                'cancel_url' => $this->cancelUrl,
            ],
        ];
    }

    public function getApprovalLink()
    {
        foreach (optional(optional($this->response)->result)->links ?? [] as $link) {
            if ($link->rel === 'approve') {
                return $link->href;
            }
        }

        return null;
    }

    public static function createOrder($reference, $amount, $currency, $returnUrl, $cancelUrl)
    {
        $paypal = new PayPal($reference, $amount, $currency, $returnUrl, $cancelUrl);

        $orderRequest = new OrdersCreateRequest();
        $orderRequest->prefer('return=representation');
        $orderRequest->body = $paypal->arrayTransaction();

        $paypal->response = $paypal->client()->execute($orderRequest);
        $paypal->approvalLink = $paypal->getApprovalLink();
        $paypal->id = optional(optional(optional($paypal)->response)->result)->id;

        return $paypal;
    }

    public static function captureOrder($orderId = null)
    {
        $paypal = new PayPal();

        $captureRequest = new OrdersCaptureRequest($orderId);
        $captureRequest->prefer('return=representation');

        $paypal->response = $paypal->client()->execute($captureRequest);
        $paypal->id = optional(optional(optional($paypal)->response)->result)->id;
        $paypal->payer = optional(optional(optional(optional($paypal)->response)->result)->payer)->email_address;
        $paypal->status = optional(optional(optional($paypal)->response)->result)->status;

        return $paypal;
    }
}
