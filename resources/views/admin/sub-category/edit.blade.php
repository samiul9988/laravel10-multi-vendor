@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Sub Category</h1>
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
                            <h4>Edit Sub Category</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.sub-category.update', $editSubCategory->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control" name="category">
                                        <option value="">Active</option>
                                        @foreach($categories as $category)
                                            <option {{$category->id == $editSubCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger">@error ('category') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$editSubCategory->name}}">
                                    <span class="text-danger">@error ('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$editSubCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$editSubCategory->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
