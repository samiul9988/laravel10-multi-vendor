@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Variant Item</h1>
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
                            <h4>Create Variant Item</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.product-variant-item-store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" class="form-control" name="variant_name" value="{{$variant->name}}" readonly>
                                    <span class="text-danger">@error ('variant_name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" name="name" value="">
                                    <span class="text-danger">@error ('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="product_id" value="{{$product->id}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="variant_id" value="{{$variant->id}}">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="">
                                    <span class="text-danger">@error ('price') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                        <option value="">Select</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    <span class="text-danger">@error ('is_default') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger">@error ('status') {{$message}} @enderror</span>
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
