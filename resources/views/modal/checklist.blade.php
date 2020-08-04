<div class="modal" tabindex="-1" role="dialog" id="checklist_modal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Checklist</h5>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success submit">Update</button>
            </div>
        </div>
    </div>
</div>
