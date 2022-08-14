<div class="modal fade" id="newCurrency" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Currency</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.settings.currency.add') }}">
                @csrf
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Name:</label>
                            <input type="text" name="name" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Symbol:</label>
                            <input type="text" name="symbol" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Exchange Rate:</label>
                            <input type="text" name="exchange_rate" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Code:</label>
                            <input type="text" name="code" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group mb-3">
                            <label for="recipient-name" class="form-label">Icon:</label>
                            <input type="text" name="icon" class="form-control" id="recipient-name">
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
