@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Variant Item Update</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Variant Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.product-variant-item-update', $variantItem->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name" value="{{$variantItem->productVariant->name}}" readonly>

                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$variantItem->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{$variantItem->price}}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="">Select</option>
                                        <option {{$variantItem->is_default == 1 ? 'Selected' : ''}} value="1">Yes</option>
                                        <option {{$variantItem->is_default == 0 ? 'Selected' : ''}} value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$variantItem->status == 1 ? 'Selected' : ''}} value="1">Active</option>
                                        <option {{$variantItem->status == 0 ? 'Selected' : ''}} value="0">Inactive</option>
                                    </select>
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection()
