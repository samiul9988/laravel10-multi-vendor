<?php

namespace App\Http\Controllers\backend;

use App\DataTables\SubCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.sub-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.sub-category.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'    => ['required'],
            'name'        => ['required', 'max:200', 'unique:sub_categories,name'],
            'status'      => ['required']
        ]);

        $category = new SubCategory();

        $category->category_id  = $request->category;
        $category->name         = $request->name;
        $category->slug         = Str::slug($request->name);
        $category->status       = $request->status;
        $category->save();

        return redirect()->route('admin.sub-category.index')->with('success', 'Sub Category Create Successfuly');
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
        $categories = Category::all();
        $editSubCategory = SubCategory::findOrfail($id);
        return view('admin.sub-category.edit', compact('editSubCategory','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category'    => ['required'],
            'name'        => ['required', 'max:200', 'unique:sub_categories,name,'.$id],
            'status'      => ['required']
        ]);

        $category = SubCategory::findOrFail($id);

        $category->category_id  = $request->category;
        $category->name         = $request->name;
        $category->slug         = Str::slug($request->name);
        $category->status       = $request->status;
        $category->save();

        return redirect()->route('admin.sub-category.index')->with('success', 'Sub Category Update Successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $chilCategory = ChildCategory::where('sub_category_id', $subCategory->id)->count();
        if ($chilCategory > 0 ){
            return response(['status'=> 'error', 'This Child Category have Sub Category!']);
        }else{
            $chilCategory->delete();
            return response(['status'=> 'success', 'Child Category Delete Successfully!']);
        }
    }

    public function changeStatus (Request $request){

        $category = SubCategory::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status Updated Successfuly']);
    }
}
