@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Update Admin Details</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md">
                        <!-- General Form Elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Update Admin Details</h3>
                            </div>
                            <!-- /.card-header -->

                            <!-- Display Session Messages -->
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
                                    <strong>Error!</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show mt-3 mx-3" role="alert">
                                    {{ Session::get('success_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show mt-3 mx-3" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <!-- Form Start -->
                            <form method="POST" action="{{ url('admin/update-admin-details') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="curr_email">Email address</label>
                                        <input class="form-control" id="curr_email"
                                            value="{{ Auth::guard('admin')->user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="curr_name">Name</label>
                                        <input type="text" name="currName" class="form-control" id="curr_name"
                                            placeholder="Name" value="{{ Auth::guard('admin')->user()->name }}">
                                        <small class="font-italic">Name must be alphabet.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="curr_mobile_phone">Mobile Phone</label>
                                        <input type="text" name="currMobilePhone" Phone class="form-control"
                                            id="curr_mobile_phone" placeholder="Mobile Phone"
                                            value="{{ Auth::guard('admin')->user()->mobile }}">
                                        <small class="font-italic">Mobile phone must be numeric.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="adm_img">Image</label>
                                        <input type="file" name="adminImage" class="form-control" id="adm_img"
                                            accept="image/*">
                                        @if (!empty(Auth::guard('admin')->user()->image))
                                            <a href="{{ asset('admin/img/photos/' . Auth::guard('admin')->user()->image) }}"
                                                target="_blank">View Image</a>
                                            <input type="hidden" name="currImg" class="form-control" id="curr_img"
                                                value="{{ Auth::guard('admin')->user()->image }}">
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
