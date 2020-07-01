<div class="modal" tabindex="-1" role="dialog" id="updateExpiry">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Update Expiration Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/stock/update/expiry') }}" method="post" id="admittedForm" onsubmit="myButton.disabled = true;">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date_expiration" id="date_expiration" required />
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
