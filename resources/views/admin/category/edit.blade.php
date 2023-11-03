@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Update Category</h1>
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
                            <h4>Category Update</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button data-selected-class="btn-danger"
                                                data-unselected-class="btn-info" name="icon" class="btn btn-primary" data-icon="{{$category->icon}}" role="iconpicker"></button>
                                        <span class="text-danger">@error ('icon') {{$message}} @enderror</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$category->name}}">
                                    <span class="text-danger">@error ('name') {{$message}} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$category->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                        <option {{$category->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
