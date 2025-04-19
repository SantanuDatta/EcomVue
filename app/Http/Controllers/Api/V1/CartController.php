<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Actions\ProcessCartAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
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
    public function store(StoreCartRequest $request, ProcessCartAction $action): JsonResponse
    {
        $cart = $action->execute(
            $request->user(),
            $request->input('product_id'),
            $request->input('quantity')
        );

        return response()->json($cart);
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
