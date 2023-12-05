<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Http\Resources\CartResource;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::check()) {
            $user = Auth::user();
        }
        return CartResource::collection(Cart::all()->where('user_id', $user->id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCartRequest $request)
    {
        $data = $request->validate([
            'item_id' => 'required|integer',
        ]);

        $item_id = $data['item_id'];

        if (Auth::check()) {
            $user_id = Auth::id();
        }

        $cart = Cart::create([
            'item_id' => $item_id,
            'user_id' => $user_id,
            'amount' => 1
        ]);

        return new CartResource($cart);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        $data = $request->validated();
        $cart->update(['amount' => $data['amount']]);
        return new CartResource($cart);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
    }
}
