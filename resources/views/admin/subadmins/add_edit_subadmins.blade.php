@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md">
                        <!-- General Form Elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>

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
                            <form method="POST"
                                action="{{ empty($subadmindata['id']) ? url('admin/add-edit-subadmin') : url('admin/add-edit-subadmin/' . $subadmindata['id']) }}"
                                name="subadminForm" id="subadmin_form" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="curr_subadmin_name">Subadmin Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" name="subadminName" class="form-control"
                                                    id="curr_subadmin_name" placeholder="Enter Subadmin Name"
                                                    value="{{ old('name', $subadmindata['name'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="curr_subadmin_mobile">Subadmin Mobile <span
                                                    class="text-danger">*</span></label>
                                                <input type="text" name="subadminMobile" id="curr_subadmin_mobile"
                                                    class="form-control" placeholder="Enter Subadmin Mobile"
                                                    value="{{ old('mobile', $subadmindata['mobile'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="curr_subadmin_email">Subadmin Email <span
                                                    class="text-danger">*</span></label>
                                                <input type="email" name="subadminEmail" class="form-control"
                                                    id="curr_subadmin_email" placeholder="Enter Subadmin Email"
                                                    value="{{ old('email', $subadmindata['email'] ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="curr_subadmin_password">Subadmin Password</label>
                                                <input type="password" name="subadminPassword" id="curr_subadmin_password"
                                                    class="form-control" placeholder="Enter Subadmin Password"
                                                    value="{{ old('password', $subadmindata['password'] ?? '') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="curr_subadmin_image">Subadmin Image</label>
                                                <input type="file" name="subadminImage" class="form-control"
                                                    id="curr_subadmin_image" accept="image/*">

                                                @if (!empty($subadmindata['image']))
                                                    <a href="{{ asset('admin/img/photos/' . $subadmindata['image']) }}"
                                                        target="_blank">View Image</a>
                                                    <input type="hidden" name="currImg" class="form-control" id="curr_img"
                                                        value="{{ $subadmindata['image'] }}">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ url('admin/subadmins') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
