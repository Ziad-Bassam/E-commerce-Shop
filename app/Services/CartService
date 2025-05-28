<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\DB;


class CartService
{
    public function getUserCartData($userId)
    {
        $cartproducts = Cart::with('Product')
            ->where('user_id', $userId)
            ->get();

        $total = Cart::where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');

        return [
            'cartproducts' => $cartproducts,
            'total' => $total ?? 0,
        ];
    }

    public function addProductToCart($productid, $userId)
    {
        $result = Cart::where('user_id', $userId)
            ->where('product_id', $productid)
            ->first();

        if ($result) {
            $result->quantity += 1;
            $result->save();
        } else {
            $newcart = new Cart();
            $newcart->product_id = $productid;
            $newcart->user_id = $userId;
            $newcart->quantity = 1;
            $newcart->save();
        }

        return true;
    }


    public function placeOrder($request, $userId)
    {
        DB::beginTransaction();

        try {
            $neworder = new Order();
            $neworder->name = $request->name;
            $neworder->address = $request->address;
            $neworder->email = $request->email;
            $neworder->phone = $request->phone;
            $neworder->note = $request->note;
            $neworder->user_id = $userId;
            $neworder->save();

            $cartproducts = Cart::with('Product')->where('user_id', $userId)->get();

            foreach ($cartproducts as $item) {
                $neworderdetails = new OrderDetails();
                $neworderdetails->product_id = $item->product_id;
                $neworderdetails->price = $item->Product->price;
                $neworderdetails->quantity = $item->quantity;
                $neworderdetails->order_id = $neworder->id;
                $neworderdetails->save();
            }

            DB::commit();

            Cart::where('user_id', $userId)->delete();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function getCartSummaryForOrderComplete($userId)
    {
        $cartproducts = Cart::with('Product')
            ->where('user_id', $userId)
            ->get();

        $total = Cart::where('user_id', $userId)
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->selectRaw('SUM(products.price * carts.quantity) as total')
            ->value('total');

        return [
            'cartproducts' => $cartproducts,
            'total' => $total ?? 0,
        ];
    }

    public function getUserPreviousOrders($userId)
    {
        return Order::with('OrderDetails')
            ->where('user_id', $userId)
            ->get();
    }

    public function deleteCartItem($cartid)
    {
        if ($cartid) {
            Cart::findOrFail($cartid)->delete();
        }
    }


}
