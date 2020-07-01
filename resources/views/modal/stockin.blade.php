<div class="modal" tabindex="-1" role="dialog" id="stockin">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Add Stocks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/supply/save/') }}" method="post" id="admittedForm" onsubmit="myButton.disabled = true; return true;">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" id="supplyAutocomplete" required>
                    </div>
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" name="brand" class="form-control" id="brandAutocomplete" required>
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit" class="form-control" required>
                            <option value="">None</option>
                            <option>pcs</option>
                            <option>btl</option>
                            <option>box</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" min="1" name="qty" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Expiration Date</label>
                        <input type="date" value="{{ date('Y-m-d') }}" name="date_expiration" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="myButton">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
