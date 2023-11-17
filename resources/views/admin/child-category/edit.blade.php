@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Child Category</h1>
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
                            <h4>Update Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.child-category.update', $chilCategory->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control main-category" name="category">
                                        <option value="">Active</option>
                                        @foreach($categories as $category)
                                            <option {{$category->id == $chilCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">@error ('category') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Sub Category</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category">

                                        @foreach($subCategories as $category)
                                            <option {{$category->id == $chilCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">@error ('category') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$chilCategory->name}}">
                                    <span class="text-danger">@error ('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$chilCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$chilCategory->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('body').on('change', '.main-category', function (e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: '{{route('admin.get-subCategories')}}',
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
    </script>
@endpush
