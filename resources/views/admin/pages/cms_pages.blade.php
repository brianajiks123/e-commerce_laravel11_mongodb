@extends('admin.layouts.layout')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pages Management</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">CMS Pages</li>
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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">CMS Pages</h3>
                                <a href="{{ url('admin/add-edit-cms-page') }}" class="btn btn-block btn-primary"
                                    style="max-width: 150px; float:right; display: inline-block;">Add CMS Page</a>
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="cms_pages" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>URL</th>
                                            <th>Created On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cms_pages as $page)
                                            <tr>
                                                <td>{{ $page->title }}</td>
                                                <td>{{ $page->url }}</td>
                                                <td>{{ $page->created_at }}</td>
                                                <td>
                                                    <a title="Edit CMS Page"
                                                        href="{{ url('admin/add-edit-cms-page/' . $page->_id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>&nbsp;&nbsp;
                                                    <a title="Delete CMS Page" record="cms-page"
                                                        record_id="{{ $page->_id }}" href="javascript:void(0)"
                                                        class="confirm_cms_page_delete" name="{{ $page->title }} page">
                                                        <i class="fas fa-trash"></i>
                                                    </a>&nbsp;&nbsp;

                                                    @if ($page->status == 1)
                                                        <a class="update_cms_page_status" id="page-{{ $page->_id }}"
                                                            page_id="{{ $page->_id }}" href="javascript:void(0)">
                                                            <i class="fas fa-toggle-on" aria-hidden="true"
                                                                status="Active"></i>
                                                        </a>
                                                    @else
                                                        <a class="update_cms_page_status" id="page-{{ $page->_id }}"
                                                            page_id="{{ $page->_id }}" href="javascript:void(0)">
                                                            <i class="fas fa-toggle-off" aria-hidden="true"
                                                                status="Inactive"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
