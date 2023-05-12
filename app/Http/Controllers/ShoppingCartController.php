<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;


class ShoppingCartController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $cart = session()->get('cart');

        $line_items = collect($cart)->map(function($item) {
            

            return [
                'price_data' => [
                    'currency' => $item["price"]["currency"],
                    'unit_amount' => $item["price"]["amount"],
                    'product_data' => [
                      'name' => $item["name"],
                      'description' => $item["description"],
                    ],
                  ],
                  'quantity' => $item["qty"],
                ];
        });

        \Stripe\Stripe::setApiKey('sk_test_51N1SWXDG1keBOliAbSkimjEJOn6lxMCe8gTFa2rL2HTkYkon49CuByVajMT5ILHY8TixU2UndLiKmn3boerH8uTE00nOOfXPCc');

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => $line_items->values()->all(),
            'mode' => 'payment',
            'success_url' => route('shop.index'),
            'cancel_url' => route('shop.index'),
        ]);

        return response('', 409)->header('X-Inertia-Location', $checkout_session->url);

        dd(session()->get('cart'));
        return Inertia::render('Shop/ShoppingCart', [
            'cart' => session()->get('cart')
        ]);
    }
}
