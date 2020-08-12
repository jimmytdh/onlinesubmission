<div class="modal" tabindex="-1" role="dialog" id="remarks_modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <form action="{{ url('/admin/report/submission/remarks') }}" method="post">
                {{ csrf_field() }}
                <div class="modal-header bg-info">
                    <h5 class="modal-title">Update Remarks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="loading_content">
                        <div class="text-center" style="padding:20px">
                            <img src="{{ url('images/loading.gif') }}" /><br />
                            <small class="text-muted">Loading...Please wait...</small>
                        </div>
                    </div>
                    <div class="main_content hidden">
                        <input type="hidden" name="bid_id" id="bid_id" />
                        <div class="form-group">
                            <label for="remarks">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="4" style="resize: none;" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending">Pending</option>
                                <option value="passed">Passed</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
