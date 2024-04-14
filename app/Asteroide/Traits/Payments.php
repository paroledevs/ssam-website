<?php

namespace App\Asteroide\Traits;

use App\Asteroide\Support\Conekta;
use App\Asteroide\Support\PayPal;
use App\Asteroide\Support\Stripe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPalHttp\HttpException;

/**
 * Payments with Stripe | PayPal
 */
trait Payments
{
    protected $order;

    protected $cart;

    protected $shippingOption;

    protected $currency;

    protected $payment;

    protected $paymentError;

    protected $payPalClient;

    protected $charge;

    protected $usedCoupon;

    protected function payWithCard(Request $request)
    {
        try {
            $charge = Stripe::createOrder($this->order->amount, $this->currency, $this->payment->stripeToken, $this->customer->email, 'Rey Amargo');

            return [
                'status' => 'paid',
                'error_message' => null,
                'payment_reference' => $charge->id,
                'payment_status' => $charge->paid,
                'message' => $charge->status,
                'paid_at' => $charge->paid ? now() : null,
                'amount' => $charge->amount / 100,
                'receipt_url' => $charge->receipt_url,
            ];
        } catch (\Stripe\Exception\CardException $e) {
            $this->paymentError = $e->getError()->message;
            $this->order->forceFill(['error_message' => $e->getError()->message, 'status' => 'error_card'])->save();
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // $this->paymentError = 'Please verify your payment information and try again.';
            $this->paymentError = $e->getError()->message;
            $this->order->forceFill(['error_message' => $e->getError()->message, 'status' => 'error_card'])->save();
        } catch (\Stripe\Exception\RateLimitException $e) {
            // $this->paymentError = 'Too many attemps, please try later to complete your order.';
            $this->paymentError = $e->getError()->message;
            $this->order->forceFill(['error_message' => $e->getError()->message, 'status' => 'error_card'])->save();
        }
    }

    public function saveSession()
    {
        session([
            'wait_for_paypal' => true,
            'paymentError' => $this->paymentError,
        ]);
    }

    public function restoreSession()
    {
        Session::remove('wait_for_paypal');
        $this->paymentError = session('paymentError');
    }

    public function forgetSessionItems()
    {
        $items = [
            'wait_for_paypal',
            'paymentError',
        ];

        foreach ($items as $item) {
            Session::remove($item);
        }
    }

    protected function payWithPayPal(Request $request)
    {
        try {
            $order = Paypal::createOrder($this->order->reference, $this->order->amount, $this->currency, $this->payPalReturnUrl, $this->payPalCancelUrl);

            session([
                'payment' => $order,
            ]);

            return [
                'payment_reference' => $order->id,
                'status' => 'waiting_paypal',
                'approval_link' => $order->approvalLink,
            ];
        } catch (HttpException $e) {
            $this->paymentError = $e->getMessage();
            $this->order->forceFill(['error_message' => $e->getMessage(), 'status' => 'error_paypal'])->save();
        }

        return [
            'status' => 'error_paypal',
            'error_message' => $this->paymentError,
        ];
    }

    protected function completePayPalPayment()
    {
        try {
            $payPalOrder = PayPal::captureOrder($this->order->payment_reference);

            if ($payPalOrder->status == 'COMPLETED') {
                return [
                    'payment_reference' => $payPalOrder->id,
                    'payment_holders_name' => $payPalOrder->payer,
                    'paid_at' => now(),
                    'status' => 'paid',
                ];
            } else {
                $this->paymentError = "We can't process the payment through your PayPal account, please try again";

                return [
                    'payment_reference' => $payPalOrder->id,
                    'status' => 'error_paypal',
                    'error_message' => (array) $payPalOrder,
                ];
            }
        } catch (HttpException $e) {
            $this->paymentError = $e->getMessage();
            $this->order->forceFill(['error_message' => $this->paymentError, 'status' => 'error_paypal'])->save();
        }
    }

    protected function payWithOxxoChash()
    {
        $items = $this->order->products->map(function ($product) {
            return [
                'name' => $product->title,
                'unit_price' => ($product->pivot->charged_price / $product->pivot->quantity) * 100,
                'quantity' => $product->pivot->quantity,
            ];
        });

        $customer = [
            'name' => $this->order->customer->full_name,
            'email' => $this->order->customer->email,
            'phone' => $this->order->customer->phone,
            'street1' => $this->order->customer->address,
            'postal_code' => $this->order->customer->postal_code,
            'country' => $this->order->customer->country,
        ];

        $shippingOption = [
            'amount' => $this->shippingOption->fee,
            'carrier' => $this->shippingOption->name,
        ];

        try {
            $order = Conekta::createOrder($items->all(), $customer, $this->currency, $shippingOption);

            return [
                'payment_reference' => $order->id,
                'status' => 'waiting_oxxo',
                'approval_link' => $order->reference,
                'expires_at' => $order->expiresAt,
            ];
        } catch (\Conekta\ParameterValidationError $e) {
            $this->paymentError = $e->getMessage();
            $this->order->forceFill(['error_message' => $this->paymentError, 'status' => 'error_oxxo'])->save();
        } catch (\Conekta\Handler $e) {
            $this->paymentError = $e->getMessage();
            $this->order->forceFill(['error_message' => $this->paymentError, 'status' => 'error_oxxo'])->save();
        }

        return [
            'status' => 'error_oxxo',
            'error_message' => $this->paymentError,
        ];
    }

    protected function anyError()
    {
        return filled($this->paymentError);
    }
}
