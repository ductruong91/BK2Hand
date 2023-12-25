<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('images', 'videos', 'categories')
            ->where('status', '2')
            ->when($request->cid, function ($query) use ($request) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->where('categories.category_id', $request->cid);
                });
            })
            ->orderBy('created_at','desc')
            ->get();

        $categories = Category::whereNull('parent_id')->get();
        foreach ($categories as $category) {
            $category->childCategories;
        }

        return view('admin', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request)
    {
        $productIds = $request->productIds;
        $products = Product::whereIn('product_id', $productIds)
            ->get();
        foreach ($products as $product) {
            $product->status = '0';
            $product->save();
        }

        alert()->success(__('Thành công'), 'Đã duyệt tất cả sản phẩm được chọn');

        return response()->json($products, 200);
    }

    public function confirm(Product $product)
    {
        $product->status = '0';
        $product->save();

        alert()->success(__('Thành công'), 'Đã thành công duyệt sản phẩm');

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $product->delete();

        alert()->success(__('Thành công'), 'Đã xóa tất cả sản phẩm được chọn');

        return redirect()->back();
    }
}
