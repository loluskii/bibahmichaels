<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="order{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">Custom Order for {{ $order->fname }} {{ $order->lname }}</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
            <div class="modal-body">
                <div class="mb-3">
                  <label for="" class="form-label">Full Name</label>
                  <input type="text" value="{{ $order->fname }} {{ $order->lname }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="text" value="{{ $order->email }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Occassion</label>
                    <input type="text" value="{{ $order->occassion }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Event Date</label>
                    <input type="text" value="{{ $order->event_date }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Measurements</label>
                    <input type="text" value="{{ $order->measurements }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Order Description</label>
                    <input type="text" value="{{ $order->order_description }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Budget</label>
                    <input type="text" value="{{ $order->budget }}" disabled id="" class="form-control" placeholder="" aria-describedby="helpId">
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    var modalId = document.getElementById('modalId');

    modalId.addEventListener('show.bs.modal', function (event) {
          // Button that triggered the modal
          let button = event.relatedTarget;
          // Extract info from data-bs-* attributes
          let recipient = button.getAttribute('data-bs-whatever');

        // Use above variables to manipulate the DOM
    });
</script>
