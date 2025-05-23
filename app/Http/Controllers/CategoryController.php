<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\CategoryService;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getPaginatedCategories(6);
        return view('welcome', ['categories' => $categories]);
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
    public function store(StoreCategoryRequest $request)
    {
        $this->categoryService->createCategory($request->validated());

        return redirect('/home')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function categories_table()
    {
        $categories = $this->categoryService->categories_table();
        return view('categories.categories_table', ['categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($catid = NULL)
    {
        $category = $this->categoryService->getCategoryById($catid);
        return view('categories.editcategory', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest  $request)
    {
        $this->categoryService->updateCategory($request->validated());
        return redirect('/home')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($catid = NULL)
    {
        $this->categoryService->destroyCategory($catid);
        return redirect('/home');
    }
}
