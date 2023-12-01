@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Product</h1>
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
                            <h4>Product Update</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.products.update', $products->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Preview</label>
                                    <img src="{{$products->thumb_image}}" width="200px">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image" value="">
                                    <span class="text-danger">@error ('thumb_image') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$products->name}}">
                                    <span class="text-danger">@error ('name') {{$message}} @enderror</span>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Category</label>
                                            <select id="inputState" class="form-control main-category" name="category">
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option {{$category->id == $products->category_id ? 'Selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub Category</label>
                                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                                <option value="">select</option>
                                                @foreach($subCategories as $subCategory)
                                                    <option {{$subCategory->id == $products->sub_category_id ? 'Selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Child Category</label>
                                            <select id="inputState" class="form-control child-category" name="child_category">
                                                <option value="">select</option>
                                                @foreach($childCategories as $childCategory)
                                                    <option {{$childCategory->id == $products->child_category_id ? 'Selected' : ''}} value="{{$childCategory->id}}">{{$childCategory->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Brand</label>
                                    <select id="inputState" class="form-control" name="brand">
                                        <option value="">Select</option>
                                        @foreach($brands as $brand)
                                            <option {{$brand->id == $products->brand_id ? 'Selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input type="number" class="form-control" name="qty" value="{{$products->qty}}">
                                    <span class="text-danger">@error ('qty') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{$products->price}}">
                                    <span class="text-danger">@error ('price') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea class="form-control" name="short_description" >{!! $products->short_description !!}</textarea>
                                    <span class="text-danger">@error ('short_description') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea class="form-control summernote" name="long_description">{!! $products->long_description !!}</textarea>
                                    <span class="text-danger">@error ('long_description') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input type="text" class="form-control" name="video_link" value="{{$products->video_link}}">
                                    <span class="text-danger">@error ('video_link') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Sku</label>
                                    <input type="text" class="form-control" name="sku" value="{{$products->sku}}">
                                    <span class="text-danger">@error ('sku') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price" value="{{$products->offer_price}}">
                                    <span class="text-danger">@error ('offer_price') {{$message}} @enderror</span>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date" value="{{$products->offer_start_date}}">
                                            <span class="text-danger">@error ('offer_start_date') {{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date" value="{{$products->offer_end_date}}">
                                            <span class="text-danger">@error ('offer_end_date') {{$message}} @enderror</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Product Type</label>
                                    <select id="inputState" class="form-control" name="product_type">
                                        <option value="0">Select</option>
                                        <option {{$products->product_type = 'new_arrival' ? 'Selected' : ''}} value="new_arrival">New Arrival</option>
                                        <option {{$products->product_type = 'featured_product' ? 'Selected' : ''}} value="featured_product">Featured</option>
                                        <option {{$products->product_type = 'top_product' ? 'Selected' : ''}} value="top_product">Top Product</option>
                                        <option {{$products->product_type = 'best_product' ? 'Selected' : ''}} value="best_product">Best Product</option>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <textarea class="form-control" name="seo_title">{!! $products->seo_title !!}</textarea>
                                    <span class="text-danger">@error ('seo_title') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Seo Description</label>
                                    <textarea class="form-control summernote" name="seo_description">{!! $products->seo_description !!}</textarea>
                                    <span class="text-danger">@error ('seo_description') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$products->status == 1 ? 'Selected' : ''}} value="1">Active</option>
                                        <option {{$products->status == 0 ? 'Selected' : ''}} value="0">Inactive</option>
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

    @push('scripts')
        <script>
            $(document).ready(function () {
                $('body').on('change', '.main-category', function (e) {

                    $('.child-category').html('<option value="">Active</option>')

                    let id = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: '{{route('admin.product-SubCategory')}}',
                        data:{
                            id:id
                        },
                        success: function (data) {
                            $('.sub-category').html('<option value="">Active</option>')
                            $.each(data, function (i, item) {
                                $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                            })
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    })
                })
            })

            /**Get Child Category*/

            $(document).ready(function () {
                $('body').on('change', '.sub-category', function (e) {
                    let id = $(this).val();
                    $.ajax({
                        method: 'GET',
                        url: '{{route('admin.product-getChildCategory')}}',
                        data:{
                            id:id
                        },
                        success: function (data) {
                            $('.child-category').html('<option value="">Active</option>')
                            $.each(data, function (i, item) {
                                $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                            })
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    })
                })
            })
        </script>
    @endpush

@endsection()
