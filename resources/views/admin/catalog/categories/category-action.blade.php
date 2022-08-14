<a data-toggle="modal" data-target="#edit-{{ $category->id }}" class="btn btn-sm btn-primary"> <i class="fa fa-pencil-square-o text-white"></i> </a>


<a href="{{ route('admin.category.delete', $category->id) }}"
    onclick="return confirm('Are you sure you want to delete this record?')" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i> </a>


<div class="modal fade" id="edit-{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit category #{{ $category->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.category.edit', $category->id) }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Name:</label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Name:</label>
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control" id="recipient-name">
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






