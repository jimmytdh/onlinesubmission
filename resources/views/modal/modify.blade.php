<div class="modal" tabindex="-1" role="dialog" id="modify_modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Submit Bid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/modify') }}" method="post" id="submitForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="bid_id" name="bid_id">
                <div class="modal-body">
                    <div class="loading_content">
                        <div class="text-center" style="padding:20px">
                            <img src="{{ url('images/loading.gif') }}" /><br />
                            <small class="text-muted">Loading...Please wait...</small>
                        </div>
                    </div>
                    <div class="main_content">
                        <div class="form-group">
                            <label>Financial Files</label>
                            <div class="custom-file">
                                <input type="file" accept=".zip,.rar,.7zip" class="custom-file-input" id="financial_file" name="financial_file" required>
                                <label class="custom-file-label" for="customFile">Choose file...</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Technical and Eligibility Files</label>
                            <div class="custom-file">
                                <input type="file" accept=".zip,.rar,.7zip" class="custom-file-input" id="technical_file" name="technical_file" required>
                                <label class="custom-file-label" for="customFile">Choose file...</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
