<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\CreateOrderAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckoutRequest;
use App\Http\Resources\Order\OrderResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CheckoutRequest $request, CreateOrderAction $action): OrderResource
    {
        $cart = session()->get('cart', ['items' => []]);

        if (empty($cart['items'])) {
            throw new HttpResponseException(
                response()->json(['error' => 'Cart is empty'], 400)
            );
        }

        $order = $action->execute(
            user: $request->user(),
            cart: $cart,
            details: $request->validated()
        );

        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): void
    {
        //
    }
}
