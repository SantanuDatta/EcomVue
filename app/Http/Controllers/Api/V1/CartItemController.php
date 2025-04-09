<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CartItemRequest;
use App\Http\Resources\CartItem\CartItemResource;
use App\Models\CartItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $cartItems = CartItem::with('product')->where('user_id', auth()->user()->id)->get();

        return CartItemResource::collection($cartItems);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartItemRequest $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem): void
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartItemRequest $request, CartItem $cartItem): void
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem): void
    {
        //
    }
}
