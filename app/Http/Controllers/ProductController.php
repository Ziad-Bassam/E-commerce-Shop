<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\StoreProductImageRequest;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productService;
    protected $categoryService;


    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($catid = null)
    {
        $products = $this->productService->getProductsByCategory($catid);

        return view('product.product', ['products' => $products]);
    }


    /**
     * Display a listing of the resource in table format.
     */


    public function products_table()
    {
        $products = Product::all();
        return view('product.productstable', ['products' => $products]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('product.addproduct',  ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(StoreProductRequest $request)
    {

        $this->productService->storeProduct($request->validated() + ['photo' => $request->file('photo')]);
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
    public function edit($productId = null)
    {
        if (!$productId) {
            abort(403, 'Please enter product id in the route');
        }

        $product = $this->productService->getProductById($productId);

        if (!$product) {
            abort(403, "Can't find this product");
        }

        $categories = $this->categoryService->getAllCategories();

        return view('product.editproduct', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request)
    {
        $data = $request->validated() + ['photo' => $request->file('photo'), 'id' => $request->id];
        $this->productService->updateProduct($data);
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productid = NULL)
    {
        if (!$productid) {
            abort(403, 'Please enter product id in the route');
        }

        $this->productService->deleteProductById($productid);

        return redirect('/products');
    }

    public function search(Request $request)
    {
        $searchKey = $request->input('searchkey', '');

        $products = $this->productService->searchProducts($searchKey);

        return view('product.product', ['products' => $products]);
    }


    public function add_product_images($productId = null)
    {
        if (!$productId) {
            abort(403, 'Please enter product id in the route');
        }
        return $this->productService->add_product_images($productId);
    }


    public function store_product_image(StoreProductImageRequest $request)
    {
        $this->productService->store_product_image($request);
        return back();
    }

    public function delete_product_photo($photoid = null)
    {
        $this->productService->deleteProductPhoto($photoid);
        return back();
    }





    public function show_single_product($productid = null)
    {
        $data = $this->productService->getSingleProductWithRelated($productid);

        return view('product.singleproduct', [
            'product' => $data['product'],
            'relatedproducts' => $data['relatedproducts']
        ]);
    }
}
