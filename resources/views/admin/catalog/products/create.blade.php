<div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add a new product</h5>
                <a type="button" class="" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></a>
            </div>
            <form method="POST" action="{{ route('admin.products.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Product Image</label>
                        <input type="file" multiple class="form-control" name="image[]" id="" placeholder=""
                            aria-describedby="fileHelpId">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="name" class="form-control" required aria-describedby="helpId">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="" class="form-label">slug</label>
                                <input type="text" name="slug" class="form-control" required aria-describedby="helpId">
                            </div>
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label for="" class="form-label">Price</label>
                        <input type="text" name="price" class="form-control" required aria-describedby="helpId">
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Select Category</label>
                        <select class="form-control" name="category_id">
                            <option value="">Select...</option>
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Description</label>
                        <textarea class="form-control" placeholder="description" name="description" id=""
                            rows="3"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="" class="form-label">Additional Information</label>
                        <textarea class="form-control" placeholder="Additional Information" name="additional_information" id=""
                            rows="3"></textarea>
                    </div>

                    <div class="table-responsive">
                        <label for="" class="form-label">Attributes</label>
                        <div class="table-responsive">
                            <table class="table table-borderless" id="dynamic_field">
                                <tr>
                                    <td class="pl-0"><input type="text" name="attributes[0][attribute_name]" placeholder="Enter attribute name"
                                            class="form-control name_list" /></td>
                                    <td><input type="text" name="attributes[0][value]" placeholder="Enter value"
                                            class="form-control name_list" /></td>
                                    <td><button type="button" name="add" id="add" class="btn btn-info btn-sm"><i
                                                class="fa fa-plus-square"></i></button></td>
                                </tr>
                            </table>
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
</div>
