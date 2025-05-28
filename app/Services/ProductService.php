<?php
namespace App\Services;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;




class ProductService
{
    public function getProductsByCategory($catid = null, $perPage = 6)
    {
        if ($catid) {
            return Product::where('category_id', $catid)->paginate($perPage);
        }

        return Product::paginate($perPage);
    }


    public function storeProduct(array $data)
    {
        $product = new Product();

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->description = $data['description'] ?? null;

        if (isset($data['photo'])) {
            $fileName = Str::uuid()->toString() . '-' . $data['photo']->getClientOriginalName();
            $path = $data['photo']->move('uploads', $fileName);
            $product->image_path = 'uploads/' . $fileName;
        }

        $product->category_id = $data['category_id'];
        $product->name_AR = '';

        $product->save();

        return $product;
    }


    public function getProductById($productId)
    {
        return Product::find($productId);
    }


    public function updateProduct(array $data)
    {
        $product = Product::findOrFail($data['id']);

        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->quantity = $data['quantity'];
        $product->description = $data['description'] ?? null;
        $product->category_id = $data['category_id'];

        if (isset($data['photo'])) {
            $fileName = Str::uuid()->toString() . '-' . $data['photo']->getClientOriginalName();
            $path = $data['photo']->move('uploads', $fileName);
            $product->image_path = 'uploads/' . $fileName;
        }

        $product->save();

        return $product;
    }

    public function deleteProductById($productid): void
    {
        $product = Product::findOrFail($productid);
        $product->delete();
    }


    public function searchProducts(string $searchKey, int $perPage = 6)
    {
        return Product::where('name', 'like', '%' . $searchKey . '%')->paginate($perPage);
    }


    public function add_product_images($productid = null)
    {
        $product = Product::findOrFail($productid);
        $productphotos = ProductPhoto::where('product_id', $productid)->get();
        return view('product.AddProductImage', [
            'product' => $product,
            'productphotos' => $productphotos
        ]);
    }

    public function store_product_image(Request $request)
    {
        $productphoto = new ProductPhoto();
        $productphoto->product_id = $request->product_id;
        $image_path = $request->photo->move('uploads', Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName());
        $productphoto->image_path = $image_path;
        $productphoto->save();
    }


    public function delete_product_photo($photoid = NULL)
    {
        if ($photoid) {
            $productPhoto = ProductPhoto::findOrFail($photoid);
            $productPhoto->delete();
            return back();
        } else {
            abort(403, 'Please enter product id in the route');
        }
    }

    public function deleteProductPhoto($photoid = null)
    {
        if ($photoid) {
            $productPhoto = ProductPhoto::findOrFail($photoid);
            $productPhoto->delete();
            return true;
        } else {
            abort(403, 'Please enter product id in the route');
        }
    }


    public function getSingleProductWithRelated($productid = null)
    {
        if ($productid) {
            $singleproduct = Product::with('Category', 'ProductPhotos')->findOrFail($productid);


            // $pricerange = $singleproduct->price * 0.10;
            // $minprice = $singleproduct->price - $pricerange;
            // $maxprice = $singleproduct->price + $pricerange;
            $relatedproducts = Product::where('category_id', $singleproduct->category_id)
                ->where('id', '!=', $productid)
                // ->whereBetween('price' ,  [ $minprice  , $maxprice])
                ->inRandomOrder()
                ->limit(3)
                ->get();

            return [
                'product' => $singleproduct,
                'relatedproducts' => $relatedproducts
            ];
        } else {
            abort(403, 'Please enter product id in the route');
        }
    }

}
