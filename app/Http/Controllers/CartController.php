<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $user_id = auth()->user()->id;
        $cartproducts = Cart::with('Product')->where('user_id' , $user_id )->get();
        $total = Cart::where('user_id', $user_id)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->selectRaw('SUM(products.price * carts.quantity) as total')
        ->value('total');
        return view('product.cart', [
            'cartproducts' => $cartproducts,
            'total' => $total ?? 0, // لو التوتال null يعني الكارت فاضي نخليه 0
        ]);    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_product_to_cart($productid)
    {

        $user_id = auth()->user()->id;

        $result = Cart::where('user_id', $user_id)->where('product_id', $productid)->first();


        if ($result) {
            $result->quantity +=1;
            $result->save();
        } else {

                $newcart = new Cart();

                $newcart -> product_id = $productid ;
                $newcart -> user_id = $user_id ;
                $newcart -> quantity = 1 ;
                $newcart -> save() ;
            }
            return back()->with('success', 'Product added to cart!');

    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:50'],
    //         'price' => ['required', 'numeric'],
    //         'address' => ['required', 'string'],
    //         'phone' => ['required'], //'regex:/^01[0-2,5]{1}[0-9]{8}$/'], egypt number
    //         'note' => ['nullable', 'string'],
    //     ]);


    //     DB::beginTransaction();

    //     try {
    //         $neworder = new Order();
    //         $neworder->name = $request->name;
    //         $neworder->price = $request->price;
    //         $neworder->address = $request->address;
    //         $neworder->phone = $request->phone;
    //         $neworder->note = $request->note;
    //         $user_id = auth()->user()->id;
    //         $neworder->user_id = $user_id;
    //         $neworder->save();

    //         $cartproducts = Cart::with('Product')->where('user_id', $user_id)->get();

    //         $total = Cart::where('user_id', $user_id)
    //             ->join('products', 'carts.product_id', '=', 'products.id')
    //             ->selectRaw('SUM(products.price * carts.quantity) as total')
    //             ->value('total');

    //         foreach ($cartproducts as $item) {
    //             $neworderdetails = new OrderDetails();
    //             $neworderdetails->product_id = $item->product_id;
    //             $neworderdetails->price = $item->Product->price;
    //             $neworderdetails->quantity = $item->quantity;
    //             $neworderdetails->order_id = $neworder->id;
    //             $neworderdetails->save();
    //         }

    //         DB::commit();
    //         Cart::where('user_id', $user_id)->delete();
    //         return view('product.completeorder')->with('success', 'The request has been sent successfully');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return back()->with('error', $e->getMessage());
    //     }

    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'email' => ['required'],
            'phone' => ['required'], //'regex:/^01[0-2,5]{1}[0-9]{8}$/'], egypt number
        ]);


        DB::beginTransaction();

        try {
            $neworder = new Order();
            $neworder->name = $request->name;
            $neworder->address = $request->address;
            $neworder->email = $request->email;
            $neworder->phone = $request->phone;
            $neworder->note = $request->note;
            $user_id = auth()->user()->id;
            $neworder->user_id = $user_id;
            $neworder->save();

            $cartproducts = Cart::with('Product')->where('user_id', $user_id)->get();
            foreach ($cartproducts as $item) {
                $neworderdetails = new OrderDetails();
                $neworderdetails->product_id = $item->product_id;
                $neworderdetails->price = $item->Product->price;
                $neworderdetails->quantity = $item->quantity;
                $neworderdetails->order_id = $neworder->id;
                $neworderdetails->save();
            }

            DB::commit();
            Cart::where('user_id', $user_id)->delete();
            return view('product.completeorder')->with('success', 'The request has been sent successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }



    }

    /**
     * Display the specified resource.
     */
    public function completeorder()
    {
        $user_id = auth()->user()->id;
        $cartproducts = Cart::with('Product')->where('user_id' , $user_id )->get();
        $total = Cart::where('user_id', $user_id)
        ->join('products', 'carts.product_id', '=', 'products.id')
        ->selectRaw('SUM(products.price * carts.quantity) as total')
        ->value('total');
        return view('product.completeorder', [
            'cartproducts' => $cartproducts,
            'total' => $total ?? 0, // لو التوتال null يعني الكارت فاضي نخليه 0
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function previous_orders()
    {
        $user_id = auth()->user()->id;

        $previous_orders = Order::with('OrderDetails')->where('user_id' , $user_id)->get();
        return view('product.previousorders', [
            'orders' => $previous_orders
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cartid = null)
    {
        if ($cartid) {
            Cart::findOrFail($cartid)->delete();
        }

        return redirect('/cart');
    }
}
