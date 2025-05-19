<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index () {

        $categories = Category::paginate(6);
        return view('welcome' , ['categories' => $categories ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.addcategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required' ,  'unique:categories,name', 'max:50'],
            'description' => ['required' , 'max:200'],
            'photo' =>  ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);

        $newcategory = new Category();
        $newcategory->name = $request->name;
        $newcategory->description = $request->description;
        $image_path = $request->photo->move('uploads' , Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName());
        $newcategory->image_path = $image_path;
        $newcategory->name_AR = '' ;
        $newcategory->save();

        return redirect('/home');
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
    public function edit($catid = NULL)
    {
        if ($catid != NULL) {

            $category = Category::findOrFail($catid);
            if($category == NULL){
                // Better than findORfail
                abort(403 , "Can't find this product");
            }
            return view('categories.editcategory' , ['category' => $category ]);
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
            'name' => ['required' ,  'unique:categories,name', 'max:50'],
            'description' => ['required' , 'max:200'],
            'photo' =>  ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ]);

        $category = Category::findorfail($request->id);
        if ($category) {
            $category->name = $request->name;
            $category->description = $request->description;
            if ($request->hasFile('photo')) {
                $image_path = $request->photo->move('uploads' , Str::uuid()->toString() . '-' . $request->photo->getClientOriginalName());
                $category->image_path = $image_path;
            }
            $category->save();
            return redirect('/home');
        } else {
            abort(403 , 'Please enter product id in the route');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catid = NULL)
    {
        $category = Category::findorfail($catid);
        if ($category) {
            $category->delete();
            return redirect('/home');
        } else {
            abort(403 , 'Please enter product id in the route');
        }
    }
}
