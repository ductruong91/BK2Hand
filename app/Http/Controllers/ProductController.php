<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        try {
            $products = Product::latest()
            ->paginate(10);

            // return response()->json([
            //     'data' => $products,
            //     'message' => 'Get all products successfully',
            //     'success' => true,
            // ], 200);

            $categories = Category::whereNull('parent_id')->get();
            foreach ($categories as $category) {
                $category->childCategories;
            }

            return view('dashboard', [
                'products' => $products,
                'categories' => $categories,
            ]);
        } catch(Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $products = Product::where('name', 'like', '%'. $request->keyword .'%')
                ->get();
            
            return view('search', [
                'products' => $products,
            ]);
        } catch(Exception $e)
        {
            return response()->json([
                'message' => 'Server Error',
                'success' => false,
            ], 500);
        }
    }

    public function store(Request $request)
    {

    }

    public function show(Product $product)
    {

    }

    public function edit(Product $product)
    {

    }

    public function update(Request $request, Product $product)
    {

    }

    public function destroy(Product $product)
    {

    }
}
