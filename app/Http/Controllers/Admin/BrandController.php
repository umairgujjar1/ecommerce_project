<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class BrandController extends Controller
{
    //
    public function index(Request $request)
    {
        $brands = Brand::latest();
        //   dd($categories);
        if (!empty($request->get('search'))) {
            $brands = $brands->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $brands = $brands->paginate(10);
        return view('Admin.Brand.list', compact('brands'));
    }
    public function create()
    {
        return view('Admin.Brand.create');
    }
    public function store(Request $request)
    {
        //
        $validator = FacadesValidator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands',
            'status' => 'required',

        ]);
        // echo $request->image;

        if ($validator->passes()) {
            $category = new Brand();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            return redirect()->route('admin.brand.index')->with('success', 'Brand Has Been Created!');
        } else {
            return redirect()->route('admin.category.create')->withErrors($validator);
        }
    }
    public function edit($id, Request $request)
    {
        //
        $brand = Brand::find($id);
        if (empty($brand)) {
            // $request->session()->flush('error', 'Record Not Found!');
            return redirect()->route('admin.brand.index')->with('error', 'Record Not Found!');
        }

        return view('Admin.Brand.edit', compact('brand'));
    }
    public function update(Request $request)
    {
        //
        $id = $request->brand_id;


        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->slug = $request->slug;
        $brand->status = $request->status;
        $brand->save();

        return redirect()->route('admin.brand.index')->with('success', 'Brand Has Been Updated!');
    }
    public function delete(string $id)
    {
        $categories = Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand Has Been Deleted!');
    }
}
