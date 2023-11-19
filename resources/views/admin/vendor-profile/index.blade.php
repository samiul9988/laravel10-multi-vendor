@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile Update</h1>
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
                            <h4>Vendor Profile Update</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.vendor-profile.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{$profile->banner}}" alt="" width="200" />
                                </div>
                                <div class="form-group">
                                    <label>Banner</label>
                                    <input type="file" class="form-control" name="banner" value="{{$profile->banner}}">
                                    <span class="text-danger">@error ('banner') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$profile->phone}}">
                                    <span class="text-danger">@error ('phone') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" value="{{$profile->email}}">
                                    <span class="text-danger">@error ('email') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="{{$profile->address}}">
                                    <span class="text-danger">@error ('address') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="summernote" name="description">{{$profile->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" class="form-control" name="fb_link" value="{{$profile->fb_link}}">
                                    <span class="text-danger">@error ('fb_link') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Tweeter</label>
                                    <input type="text" class="form-control" name="tw_link" value="{{$profile->tw_link}}">
                                    <span class="text-danger">@error ('tw_link') {{$message}} @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" name="inst_linik" value="{{$profile->inst_link}}">
                                    <span class="text-danger">@error ('inst_linik') {{$message}} @enderror</span>
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
