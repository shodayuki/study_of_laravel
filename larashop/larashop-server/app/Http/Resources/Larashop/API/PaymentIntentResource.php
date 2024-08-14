<?php

namespace App\Http\Resources\Larashop\API;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \Stripe\PaymentIntent */
class PaymentIntentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'client_secret' => $this->client_secret,
        ];
    }
}
