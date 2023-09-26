<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $sub_categories = SubCategory::select('sub_categories.*', 'categories.name as CategoryName')
            ->latest('sub_categories.id')
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');
        //   dd($categories);
        if (!empty($request->get('search'))) {
            $sub_categories = $sub_categories->where('sub_categories.name', 'like', '%' . $request->get('search') . '%');
            $sub_categories = $sub_categories->orWhere('categories.name', 'like', '%' . $request->get('search') . '%');
        }
        $sub_categories = $sub_categories->paginate(10);
        return view('Admin.Sub_Category.list', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('Admin.Sub_Category.create_sub_category', compact('categories'));
    }
    public function store(Request $request)
    {
        // $validatore = Validator::make($request->all(),[
        //     'name' => 'required',
        //    'slug' => 'required',
        //     'category' => 'required',
        //     'status' => 'required'
        // ]);

        // if($validatore->passes()){
        //      echo "fda";
        // }else{
        //     return redirect()->route('admin.sub-category.create')->with('error','Sub-category is not crated!');
        // }
        $category = new SubCategory;
        $category->name = $request->name;
        $category->category_id = $request->category;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->showHome = $request->showHome;
        $category->save();
        return redirect()->back()->with('success', 'SubCategory Has been Created!');
    }

    public function edit($id, Request $request)
    {
        //
        $sub_categories = SubCategory::find($id);
        if (empty($sub_categories)) {
            // $request->session()->flush('error', 'Record Not Found!');
            return redirect()->route('admin.sub-category.index')->with('error','Record Not Found!');
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('Admin.Sub_Category.edit', compact('sub_categories', 'categories'));
    }

    public function update(Request $request)
    {
        //
       $id = $request->sub_category_id;


            $sub_category = SubCategory::find($id);
            $sub_category->category_id = $request->category;
            $sub_category->name = $request->name;
            $sub_category->slug = $request->slug;
            $sub_category->status = $request->status;
            $sub_category->showHome = $request->showHome;
            $sub_category->save();

            return redirect()->route('admin.sub-category.index')->with('success', 'Sub_Category Has Been Updated!');

    }
    public function delete(string $id)
    {
        $categories = SubCategory::find($id)->delete();
        return redirect()->back()->with('success', 'Sub-Category Has Been Deleted!');
    }

}
