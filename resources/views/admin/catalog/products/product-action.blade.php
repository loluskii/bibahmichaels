<a data-toggle="modal" data-target="#editProduct-{{ $product->id }}" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-square-o text-white"></i> </a>


<a href="{{ route('admin.products.delete', $product->id) }}"
    onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i> </a>


<div class="modal fade" id="editProduct-{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit product #{{ $product->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Image</label>
                        <input type="file" multiple class="form-control" name="image[]" id="" placeholder="" aria-describedby="fileHelpId">
                    </div>

                    <div class="row g-2">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" value="{{ $product->name }}"
                                    required aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">slug</label>
                                <input type="text" name="slug" value="{{ $product->slug }}" class="form-control" value="{{ $product->slug }}"
                                    required aria-describedby="helpId">
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select class="form-control" name="category">
                        <option value=""></option>
                            @foreach ($category as $item)
                            <option value="">Select...</option>
                            <option {{$product->category_id == $item->id  ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="description" name="description" id=""
                            rows="4">{{ $product->description }}</textarea>
                    </div>
                    <div class="row g-2">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Unit Price</label>
                                <input type="text" name="unit_price" class="form-control" value="{{ $product->price }}" required
                                    aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Number of Units</label>
                                <input type="text" name="units" class="form-control" placeholder="Quantity"
                                    aria-describedby="helpId" value="{{ $product->units }}">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
</div>






