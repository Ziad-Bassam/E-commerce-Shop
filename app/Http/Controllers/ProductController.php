<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($catid = NULL) {

        if($catid){
        // = if($catid = null)

            $products = Product::where('category_id' , $catid)->paginate(6);
            return view('product.product' , ['products' => $products ]);

        }

        else{

            $products = Product::paginate(6);
            return view('product.product' , ['products' => $products ]);

        }
    }


    public function products_table(){
        $products = Product::all();
        return view('product.productstable' , ['products' => $products ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required' , 'max:50'],
            'price' => ['required' ],
            'quantity' => ['required' ],
            'category_id' => ['required'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $newproduct = new Product();
        $newproduct->name = $request->name;
        $newproduct->price = $request->price;
        $newproduct->quantity = $request->quantity;
        $newproduct->description = $request->description;
        $image_path = $request->photo->move('uploads' , Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName());
        $newproduct->image_path = $image_path;
        $newproduct->category_id = $request->category_id;
        $newproduct->name_AR = '';
        $newproduct->save();

        return redirect('/addproduct');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($productid = NULL)
    {
        if ($productid != NULL) {

            $product = Product::findOrFail($productid);
            if($product == NULL){
                // Better than findORfail
                abort(403 , "Can't find this product");
            }
            $categories = Category::all();
            return view('product.editproduct' , ['product' => $product , 'categories' => $categories]);
        } else {
            abort(403 , 'Please enter product id in the route');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required' , 'max:50'],
            'price' => ['required' ],
            'quantity' => ['required' ],
            'category_id' => ['required'],
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        if ($request->has('photo')) {
            $image_path = $request->photo->move('uploads' , Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName());
            $product->image_path = $image_path;
        }

        $product->save();

        return redirect('/products');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productid = NULL)
    {
        if ($productid) {
            $product = Product::findorfail($productid);
            $product->delete();
            return redirect('/products');
        } else {
            abort(403 , 'Please enter product id in the route');
        }


    }

    public function addproduct(){
        $categories = Category::all();
        return view('product.addproduct',  ['categories' => $categories]);
    }

    public function search(Request $request){
        $products = Product::where('name' , 'like' , '%'. $request->searchkey .'%')->paginate(6);
        return view('product.product',  ['products' => $products]);
    }


    public function add_product_images($productid= NULL){

        $product = Product::findOrFail($productid);
        $productphotos = ProductPhoto::where('product_id',$productid)->get();
        return view('product.AddProductImage',  ['product' => $product , 'productphotos' => $productphotos]);
        abort(403 , 'Please enter product id in the route');
    }

    public function delete_product_photo($photoid = NULL)
    {
        if ($photoid) {
            $product = ProductPhoto::findorfail($photoid);
            $product->delete();
            return back();
        } else {
            abort(403 , 'Please enter product id in the route');
        }


    }




    public function store_product_image(Request $request){
        $request->validate([
            'product_id' => ['required'],
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $productphoto = new ProductPhoto();
        $productphoto->product_id = $request->product_id;
        $image_path = $request->photo->move('uploads' , Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName());
        $productphoto->image_path = $image_path;
        $productphoto->save();
        return back();

    }



    public function show_single_product($productid = NULL){
        if ($productid) {
            $singleproduct = Product::with('Category', 'ProductPhotos')->findOrFail($productid);



            // $pricerange = $singleproduct->price * 0.10;
            // $minprice = $singleproduct->price - $pricerange;
            // $maxprice = $singleproduct->price + $pricerange;
            $relatedproducts = Product::where('category_id' , $singleproduct->category_id)
            ->where('id' , '!=' , $productid)
            // ->whereBetween('price' ,  [ $minprice  , $maxprice])
            ->inRandomOrder()
            ->limit(3)
            ->get();


            return view('product.singleproduct' , [ 'product' => $singleproduct , 'relatedproducts' => $relatedproducts]);
        } else {
            abort(403 , 'Please enter product id in the route');
        }
    }





}
