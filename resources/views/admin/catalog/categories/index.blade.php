@extends('admin.layout.app')

@section('title')
Categories List
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $categories->count() }} <i class=" icon-briefcase float-right"></i></h3>
                <span>Total Categories</span>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header d-flex justify-content-between">
                <h2>All Categories</h2>
                <button data-toggle="modal" data-target="#newCategory" class="btn btn-secondary btn-sm">New catergory</button>
                @include('admin.catalog.categories.create')
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)

                            <tr>
                                <td>{{ ++$key }}</td>
                                <td class="text-uppercase">{{ $category->name }}</td>
                                <td>
                                    @include('admin.catalog.categories.category-action')
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
