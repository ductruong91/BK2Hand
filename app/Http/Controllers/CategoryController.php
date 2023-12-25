<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all()->whereNull('parent_id');
        foreach ($categories as $category) {
            $category->subCategories;
        }
        return response()->json([
            'data' => $categories,
        ], 200);
    }

    public function show(Category $category)
    {
        return response()->json($category, 200);
    }
}
