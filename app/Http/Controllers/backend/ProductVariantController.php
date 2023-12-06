<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use function Yajra\DataTables\render;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ProductVariantDataTable $dataTable)
    {
        $product = Product::findOrFail($request->product);
        return $dataTable->render('admin.product.product-variant.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.product-variant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product' => ['required'],
            'name'    => ['required', 'max:200'],
            'status'  => ['required']
        ]);

        $productVariant = new ProductVariant();

        $productVariant->product_id = $request->product;
        $productVariant->name       = $request->name;
        $productVariant->status     = $request->status;

        $productVariant->save();

        return redirect()->route('admin.product-variant.index', ['product' => $request->product]);
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
        $variant = ProductVariant::findOrFail($id);
        return view('admin.product.product-variant.edit',compact('variant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'    => ['required', 'max:200'],
            'status'  => ['required']
        ]);

        $productVariant         = ProductVariant::findOrFail($id);

        $productVariant->name   = $request->name;
        $productVariant->status = $request->status;

        $productVariant->save();

        return redirect()->route('admin.product-variant.index', ['product' => $productVariant->product_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $variant = ProductVariant::findOrFail($request->id);
        $variant->status = $request->status == 'true' ? 1 : 0;
        $variant->save();

        return response(['success'=> 'message', 'Status update successfully']);
    }
}
