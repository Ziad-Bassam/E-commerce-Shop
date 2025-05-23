<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryService
{

    public function categories_table()
    {
        return Category::all();
    }



    public function getCategoryById($catid = null)
    {
        if ($catid === null) {
            abort(403, 'Please enter product id in the route');
        }

        return Category::findOrFail($catid);
    }



    public function createCategory($data)
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->image_path = $this->handleImageUpload($data['photo']);
        $category->name_AR = '';
        $category->save();

        return $category;
    }

    public function updateCategory($data)
    {
        $category = Category::findOrFail($data['id']);
        $category->name = $data['name'];
        $category->description = $data['description'];

        if (isset($data['photo'])) {
            $category->image_path = $this->handleImageUpload($data['photo']);
        }

        $category->save();

        return $category;
    }

    public function destroyCategory($catid = null)
    {
        if ($catid === null) {
            abort(403, 'Please enter product id in the route');
        }

        $category = Category::findOrFail($catid);

        $category->delete();

        return true;
    }

    public function getPaginatedCategories($perPage = 6)
    {
        return Category::paginate($perPage);
    }

    private function handleImageUpload($image)
    {
        $imageName = Str::uuid()->toString() . '-' . $image->getClientOriginalName();
        return $image->move('uploads', $imageName);
    }
}
