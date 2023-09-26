<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::latest();
        //   dd($categories);
        if (!empty($request->get('search'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $categories = $categories->paginate(10);
        return view('Admin.Category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'image' => 'required|image',

        ]);
        // echo $request->image;

        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            if ($request->image) {

                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/categories'), $imageName);

                $category->image = $imageName;
            }
            $category->save();

            return redirect()->route('admin.category.create')->with('success', 'Category Has Been Created!');
        } else {
            return redirect()->route('admin.category.create')->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categories = Category::find($id);
        if (empty($categories)) {
            return redirect()->route('admin.category.index');
        }
        return view('Admin.Category.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        $id = $request->id;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required'
        ]);
        if ($validator->passes()) {
            $category = Category::find($id);
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            return redirect()->route('admin.category.index')->with('success', 'Category Has Been Updated!');
        } else {
            return redirect()->back()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $categories = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category Has Been Deleted!');
    }
}
