<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $products = DB::table('products')
                ->select('products.*', 'categories.name as category_name')
                ->join('product_category', 'products.product_id', '=', 'product_category.product_id')
                ->join('categories', 'product_category.category_id', '=', 'categories.category_id')
                ->when($request->keyword, function ($query) use ($request) {
                    $query->where('products.name','like','%'. $request->keyword . '%');
                })
                ->when($request->cid, function ($query) use ($request) {
                    $query->where('categories.category_id', '=', $request->cid);
                })
                ->paginate(6);
            
            return view('search', [
                'products' => $products->appends(request()->except('page')),
            ]);
        } catch(Exception $e)
        {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 500);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    public function show($id)
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
