<?php

namespace App\Http\Controllers\backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use function Livewire\name;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.child-category.create', compact('categories'));
    }
    /**
     * Get Sub Categories.
     */
    public function getSubCategories(Request $request){

        $getSubCategories = SubCategory::where('category_id', $request->id)->where('status', 1)->get();

        return $getSubCategories;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category'      => ['required'],
            'sub_category'  => ['required'],
            'name'          => ['required', 'max:200', 'unique:child_categories,name'],
            'status'        => ['required']
        ]);

        $childCategory = new ChildCategory();

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        return redirect()->route('admin.child-category.index');
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
        $categories     = Category::all();
        $chilCategory   = ChildCategory::findOrFail($id);
        $subCategories  = SubCategory::where('category_id', $chilCategory->category_id)->get();
        return view('admin.child-category.edit', compact('categories', 'chilCategory', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category'      => ['required'],
            'sub_category'  => ['required'],
            'name'          => ['required', 'max:200', 'unique:child_categories,name,'.$id],
            'status'        => ['required']
        ]);

        $childCategory = ChildCategory::findOrFail($id);

        $childCategory->category_id = $request->category;
        $childCategory->sub_category_id = $request->sub_category;
        $childCategory->name = $request->name;
        $childCategory->slug = Str::slug($request->name);
        $childCategory->status = $request->status;
        $childCategory->save();

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->delete();

        return response(['success'=>'Child Category delete Successfuly']);
    }

    public function changeStatus(Request $request){
        $childCategory = ChildCategory::findOrFail($request->id);
        $childCategory->status = $request->status == 'true' ? 1 : 0;
        $childCategory->save();

        return response(['success'=> 'Status Update Successfuly!']);
    }
}
