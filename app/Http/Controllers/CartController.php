<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //



    public function addToCart(Request $request)
    {
        $product =  Product::with('product_images')->find($request->id);
        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Record Not found'
            ]);
        }
        if (Cart::count() > 0) {
            // echo 'Product Already in Cart';
            $cartContent = Cart::content();
            $alreadyExist = false;
            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $alreadyExist = true;
                }
            }
            if ($alreadyExist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
                $status = true;
                $message = $product->title . ' Product is  added in cart';
            } else {

                $status = false;
                $message = $product->title . ' Product is already  added in cart';
            }
        } else {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
            $status = true;
            $message = $product->title . ' Product added to cart';
        }
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function cart()
    {
        $cartContent = Cart::content();
        // dd(Cart::content());
        return view('User.cart', compact('cartContent'));
    }
    public function updateCart(Request $request)
    {
        $rowId  = $request->rowId;
        $qty  = $request->qty;
        $itemId = Cart::get($rowId);
        $product = Product::find($itemId->id);

        if ($product->track_qty == 'Yes') {
            if ($product->qty >= $qty) {
                Cart::update($rowId, $qty);
                $status = true;
                $message = 'Cart has Been Updated!';
            } else {
                $message = 'Product qty(' . $qty . ') is Out of stock!';
                $status = false;
            }
        }

        session()->flash('success', $message);
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }
}
