<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CartService;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $userId = auth()->id();
        $data = $this->cartService->getUserCartData($userId);

        return view('product.cart', [
            'cartproducts' => $data['cartproducts'],
            'total' => $data['total'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_product_to_cart($productid)
    {
        $userId = auth()->id();
        $this->cartService->addProductToCart($productid, $userId);
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


    public function store(CartRequest $request)
    {
        $userId = auth()->id();

        try {
            $this->cartService->placeOrder($request, $userId);
            return view('product.completeorder')->with('success', 'The request has been sent successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function completeorder()
    {
        $userId = auth()->id();
        $data = $this->cartService->getCartSummaryForOrderComplete($userId);

        return view('product.completeorder', [
            'cartproducts' => $data['cartproducts'],
            'total' => $data['total'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function previous_orders()
    {
        $userId = auth()->id();
        $orders = $this->cartService->getUserPreviousOrders($userId);

        return view('product.previousorders', [
            'orders' => $orders
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($cartid = null)
    {
        $this->cartService->deleteCartItem($cartid);
        return redirect('/cart');
    }
}
