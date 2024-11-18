@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pages Management</h1>
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
                                action="{{ empty($cms_page['id']) ? url('admin/add-edit-cms-page') : url('admin/add-edit-cms-page/' . $cms_page['id']) }}"
                                name="cmsPageForm" id="cms_page_form">
                                @csrf
                                
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="curr_title">Title <span class="text-danger">*</span></label>
                                        <input type="text" name="title" class="form-control" id="curr_title"
                                            placeholder="Enter Title" value="{{ old('title', $cms_page['title'] ?? '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="curr_description">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" id="curr_description" rows="3" class="form-control" placeholder="Enter ...">{{ old('description', $cms_page['description'] ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ url('admin/cms-pages') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
