@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Child Category Table</h1>
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
                            <h4>Simple Table</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.child-category.create')}}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        <script>
            $(document).ready(function () {
                $('body').on('click', '.change-status', function () {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');
                    let csrfToken = $('meta[name="csrf-token"]').attr('content'); // Extract CSRF token

                    $.ajax({
                        url: "{{ route('admin.child-category.change-status') }}", // Use the named route
                        method: 'PUT',
                        data: {
                            _token: csrfToken, // Include the CSRF token
                            status: isChecked,
                            id: id
                        },
                        success: function (data) {
                            toastr.success(data.message);
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });
                });
            });


        </script>
    @endpush
@endsection()
