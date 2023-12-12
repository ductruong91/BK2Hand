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
        $regExp = [
            '/[aáảàạãăắẳằặẵâấẩầậẫ]/iu' => '[aáảàạãăắẳằặẵâấẩầậẫ]',
            '/[eéẻèẹẽêếểềệễ]/iu' => '[eéẻèẹẽêếểềệễ]',
            '/[iíỉìịĩ]/iu' => '[iíỉìịĩ]',
            '/[uúủùụũưứửừựữ]/iu' => '[uúủùụũưứửừựữ]',
            '/[oóỏòọõôốổồộỗơớởờợỡ]/iu' => '[oóỏòọõôốổồộỗơớởờợỡ]',
            '/[yýỷỳỵỹ]/iu' => '[yýỷỳỵỹ]',
            '/[dđ]/iu' => '[dđ]',
        ];

        try {
            $result = $request->keyword;
            foreach ($regExp as $key => $value) {
                $result = preg_replace($key, $value, $result);
            }

            $products = Product::with('categories')
                ->when($request->keyword, function ($query) use ($request, $result) {
                    $query->where('products.name', 'REGEXP', $result);
                })
                ->when($request->cid, function ($query) use ($request) {
                    $query->whereHas('categories', function ($query) use ($request) {
                        $query->where('categories.category_id', $request->cid);
                    });
                })
                ->when($request->priceRange != 0, function ($query) use ($request) {
                    $between = [
                        '1' => ['0','100000'],
                        '2' => ['100000','500000'],
                        '3' => ['500000','1000000'],
                        '4' => ['1000000', '99999999999'],
                    ];
                    $query->whereRaw('CONVERT(price, SIGNED) BETWEEN ? and ?', $between[$request->priceRange]);
                })
                ->when($request->sortByPrice != 0, function ($query) use ($request) {
                    if ($request->sortByPrice == 1) $query->orderByRaw('CONVERT(products.price, SIGNED) asc');
                    else $query->orderByRaw('CONVERT(products.price, SIGNED) desc');
                })
                ->when($request->sortByCreatedAt != 0, function ($query) use ($request) {
                    if ($request->sortByCreatedAt == 1) $query->orderBy('created_at', 'asc');
                    else $query->orderBy('created_at', 'desc');
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
