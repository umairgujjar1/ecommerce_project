<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subcategorySlug = null)
    {
        $selectedCategory = '';
        $selectedSubCategory = '';
        $brandArray = [];
        $price_min = (intval($request->get('price_min')) == 0) ? 0 : intval($request->get('price_min'));
        $price_max = (intval($request->get('price_max')) == 0) ? 750 : intval($request->get('price_max'));



        $categories = Category::orderBy('name', 'ASC')->with('sub_category')->where('status', 1)->get();
        $brands = Brand::orderBy('name', 'ASC')->where('status', 1)->get();

        //////filters
        $products = Product::latest()->where('status', 1);
        if (!empty($request->get('search'))) {
            $products = $products->where('title', 'like', '%' . $request->get('search') . '%');
        }




        if (!empty($categorySlug)) {
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id', $category->id);
            $selectedCategory = $category->id;
        }
        if (!empty($subcategorySlug)) {
            $subCategory = SubCategory::where('slug', $subcategorySlug)->first();

            $products = $products->where('sub_category_id', $subCategory->id);
            $selectedSubCategory = $subCategory->id;
        }
        if (!empty($request->get('brands'))) {
            $brandArray = explode(',', $request->get('brands'));
            $products = $products->whereIn('brand_id', $brandArray);
        }
        if ($request->get('price_max') != '' && $request->get('price_min') != '') {
            $products = $products->whereBetween('price', [intval($request->get('price_min')), intval($request->get('price_max'))]);
        }

        $products = $products->paginate(9);


        // ->paginate(9);

        return view('User.shop', compact('categories', 'brands', 'products', 'selectedSubCategory', 'selectedCategory', 'brandArray', 'price_min', 'price_max'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->with('product_images')->first();
        $categoryId = $product->category_id;
        $related_products = Product::where('category_id', $categoryId)->with('product_images')->get();
        if ($product == null) {
            abort(404);
        }

           return view('User.product',compact('product','related_products'));
    }
}
