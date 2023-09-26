<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class productsController extends Controller
{
    //

    public function index(Request $request)
    {
        $products = Product::latest()->with('product_images')
            ->paginate(10);
        if (!empty($request->search)) {
            $products = Product::where('title', 'like', '%' . $request->search . '%')->with('product_images')->paginate(10);
        }
        // $product_images = ProductImage::get();
        return view('Admin.Products.view_products', compact('products'));
    }
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();

        return view('Admin.Products.create', compact('categories', 'brands'));
    }
    public function store(Request $request)
    {

        $rules = [
            'title' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
        }
        $validatore = Validator::make($request->all(), $rules);
        if ($validatore->passes()) {



            $product = new Product;
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            // $product->related_products = $request->related_products;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->save();
            $product_id = $product->id;
            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName =  $product_id . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('images/products_images'), $imageName);

                    $productImages = new ProductImage;
                    $productImages->image = $imageName;
                    $productImages->product_id = $product_id;
                    $productImages->save();
                }
            }
            return redirect()->route('admin.product.index')->with('success', 'New Product Has been Created!');
        } else {
            return redirect()->back()->withErrors($validatore->errors());
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brand::orderBy('name', 'ASC')->get();
        $sub_categories = SubCategory::where('category_id', $product->sub_category_id)->get();
        return view('Admin.Products.edit', compact('product', 'categories', 'sub_categories', 'brands'));
    }
    public function update(Request $request)
    {

        $rules = [
            'title' => 'required',
            'slug' => 'required',
            'price' => 'required|numeric',
            'sku' => 'required',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        if (!empty($request->track_qty) && $request->track_qty == 'Yes') {
            $rules['qty'] = 'required|numeric';
        }
        $validatore = Validator::make($request->all(), $rules);
        if ($validatore->passes()) {

            $id = $request->product_id;

            $product = Product::find($id);
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->shipping_returns = $request->shipping_returns;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->save();
            $product_id = $product->id;
            if ($request->file('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName =  $product_id . '_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                    $image->move(public_path('images/products_images'), $imageName);

                    $productImages = new ProductImage;
                    $productImages->image = $imageName;
                    $productImages->product_id = $product_id;
                    $productImages->save();
                }
            }
            return redirect()->route('admin.product.index')->with('success', 'Product has been Updated!');
        } else {
            return redirect()->back()->withErrors($validatore->errors());
        }
    }

    public function delete($id)
    {
        $products = Product::find($id);
        $productImages = ProductImage::where('product_id', $id)->get();

        if (!$productImages->isEmpty()) {
            foreach ($productImages as $productImage) {
                File::delete(public_path('images/products_images/' . $productImage->image));
            }
           Product::find($id)->delete();
             ProductImage::where('product_id', $id)->delete();
            return redirect()->back()->with('success', 'Record has been Deleted!');
            } else {
            return redirect()->back()->with('error', 'No Record Found');
        }
    }
}
