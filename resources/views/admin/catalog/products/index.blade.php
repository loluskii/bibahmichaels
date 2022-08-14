@extends('admin.layout.app')

@section('title')
Products List
@endsection



@section('content')
<div class="row clearfix w-100">
    <div class="col-lg-3 col-md-6">
        <div class="card overflowhidden">
            <div class="body">
                <h3>{{ $products->count() }} <i class=" icon-briefcase float-right"></i></h3>
                <span>Total Products</span>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix w-100">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="d-flex justify-content-between header">
                <h2>All Products</h2>
                <button data-toggle="modal" data-target="#createProduct" class="btn btn-secondary btn-sm">New
                    Product</button>
                @include('admin.catalog.products.create')
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->count() > 0)
                                @foreach ($products as $key => $product)

                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td class="text-uppercase">{{ $product->name }}</td>
                                    <td>£{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->category->name ?? 'No Category' }}</td>
                                    <td>
                                        @include('admin.catalog.products.product-action')
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr class="text-center" >
                                <td colspan="5">No Products</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    var i=1;
    $('#add').click(function(){
        i++;
        $('#dynamic_field').append('<tr><td class="pl-0"><input type="text" name="attributes['+i+'][attribute_name]" placeholder="Enter attribute name" class="form-control name_list" /></td> <td><input type="text" name="attributes['+i+'][value]" placeholder="Enter value" class="form-control name_list" /></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove btn-sm"><i class="fa fa-minus"></i></button></td> </tr>');
    });
    $(document).on('click', '.btn_remove', function(){
        $(this).parents('tr').remove();
    });
</script>
@endsection
