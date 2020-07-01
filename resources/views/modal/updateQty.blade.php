<div class="modal" tabindex="-1" role="dialog" id="updateQty">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Update Qty</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/stock/update/qty') }}" method="post" id="admittedForm" onsubmit="myButton.disabled = true;">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="number" class="form-control" name="qty" id="qty" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="myButton">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
