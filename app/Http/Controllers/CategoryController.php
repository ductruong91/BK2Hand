<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->get();
        foreach ($categories as $category) {
            $category->childCategories;
        }
        return response()->json([
            'data' => $categories,
        ], 200);
    }
}
