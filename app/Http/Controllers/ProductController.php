<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        $products = Product::all();
        return $dataTable->render('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands      = Brand::all();
        return view('admin.product.create', compact('categories','brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'max:200'],
            'image'             => ['required', 'max:3000'],
            'category'          => ['required'],
            'brand'             => ['required'],
            'qty'               => ['required'],
            'price'             => ['required'],
            'short_description' => ['required', 'max:200'],
            'long_description'  => ['required', 'max:250'],
            'sku'               => ['required'],
            'product_type'      => ['required'],
            'seo_title'         => ['required'],
            'seo_description'   => ['required'],
            'status'            => ['required']
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $products = new Product();

        $products->thumb_image          = $imagePath;
        $products->name                 = $request->name;
        $products->slug                 = Str::slug($request->name);
        $products->vendor_id            = Auth::user()->vendor->id;
        $products->category_id          = $request->category;
        $products->sub_category_id      = $request->sub_category;
        $products->child_category_id    = $request->child_category;
        $products->brand_id             = $request->brand;
        $products->qty                  = $request->qty;
        $products->short_description    = $request->short_description;
        $products->long_description     = $request->long_description;
        $products->video_link           = $request->video_link;
        $products->sku                  = $request->sku;
        $products->price                = $request->price;
        $products->offer_price          = $request->offer_price;
        $products->offer_start_date     = $request->offer_start_date;
        $products->offer_end_date       = $request->offer_end_date;
        $products->product_type               = $request->product_type;
        $products->status               = $request->status;
        $products->is_approved          = 1;
        $products->seo_title            = $request->seo_title;
        $products->seo_description      = $request->seo_description;

        $products->save();

        return redirect()->route('admin.products.index');
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
        $products = Product::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $products->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $products->sub_category_id)->get();
        $categories = Category::all();
        $brands     = Brand::all();
        return view('admin.product.edit',compact('categories','brands','products','subCategories','childCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'              => ['required', 'max:200'],
            'image'             => ['nullable'],
            'category'          => ['required'],
            'brand'             => ['required'],
            'qty'               => ['required'],
            'price'             => ['required'],
            'short_description' => ['required', 'max:200'],
            'long_description'  => ['required', 'max:250'],
            'sku'               => ['required'],
            'product_type'      => ['required'],
            'seo_title'         => ['required'],
            'seo_description'   => ['required'],
            'status'            => ['required']
        ]);

        $products = Product::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'uploads', $products->thumb_image);


        $products->thumb_image          = empty(!$imagePath ? $imagePath : $products->thumb_image);
        $products->name                 = $request->name;
        $products->slug                 = Str::slug($request->name);
        $products->vendor_id            = Auth::user()->vendor->id;
        $products->category_id          = $request->category;
        $products->sub_category_id      = $request->sub_category;
        $products->child_category_id    = $request->child_category;
        $products->brand_id             = $request->brand;
        $products->qty                  = $request->qty;
        $products->short_description    = $request->short_description;
        $products->long_description     = $request->long_description;
        $products->video_link           = $request->video_link;
        $products->sku                  = $request->sku;
        $products->price                = $request->price;
        $products->offer_price          = $request->offer_price;
        $products->offer_start_date     = $request->offer_start_date;
        $products->offer_end_date       = $request->offer_end_date;
        $products->product_type               = $request->product_type;
        $products->status               = $request->status;
        $products->is_approved          = 1;
        $products->seo_title            = $request->seo_title;
        $products->seo_description      = $request->seo_description;

        $products->save();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Get Sub Category.
     */
    public function getSubCategory (Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();

        return $subCategories;
    }

    /**
     * Get Child Category.
     */

    public function getChildCategory (Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

        return $childCategories;
    }
}
