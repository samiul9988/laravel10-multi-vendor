<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class ProductVariantItemController extends Controller
{
    public function index(ProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);

        return $dataTable->render('admin.product.product-variant-item.index',compact('product','variant'));
    }

    public function create(String $productIt, String $variantId)
    {
        $product = Product::findOrFail($productIt);
        $variant = ProductVariant::findOrFail($variantId);

        return view('admin.product.product-variant-item.create',compact('product', 'variant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'variant_id'    => ['integer', 'required'],
            'name'          => ['required'],
            'price'         => ['required'],
            'is_default'    => ['required'],
            'status'        => ['required']
        ]);

        $productVariantItem = new ProductVariantItem();

        $productVariantItem->product_variant_id = $request->variant_id;
        $productVariantItem->name               = $request->name;
        $productVariantItem->price              = $request->price;
        $productVariantItem->is_default         = $request->is_default;
        $productVariantItem->status             = $request->status;

        $productVariantItem->save();

        return redirect()->route('admin.product-variant-item-index', ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }

    public function edit(String $variantId)
    {
        $variantItem = ProductVariantItem::findOrFail($variantId);
        return view('admin.product.product-variant-item.edit',compact('variantItem'));
    }

    public function update(Request $request, $varinatId)
    {
        $request->validate([
            'name'          => ['required'],
            'price'         => ['required'],
            'is_default'    => ['required'],
            'status'        => ['required']
        ]);

        $productVariantItem = ProductVariantItem::findOrFail($varinatId);

        $productVariantItem->name               = $request->name;
        $productVariantItem->price              = $request->price;
        $productVariantItem->is_default         = $request->is_default;
        $productVariantItem->status             = $request->status;

        $productVariantItem->save();

        return redirect()->route('admin.product-variant-item-index', ['productId' => $productVariantItem->productVariant->product_id, 'variantId' => $productVariantItem->product_variant_id]);
    }

    public function destroy(String $variantId)
    {
        $variantItem = ProductVariantItemDataTable::findOrFail($variantId);
        $variantItem->delete();

        return redirect()->back();
    }

    public function changeStatus(Request $request)
    {
        $variantItem = ProductVariantItem::findOrFail($request->id);
        $variantItem->status = $request->status == 'true' ? 1 : 0;
        $variantItem->save();

        return response(['success'=> 'message', 'Status update successfully']);
    }

}
