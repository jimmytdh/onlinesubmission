<div class="modal" tabindex="-1" role="dialog" id="submit_modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Submit Bid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/submit') }}" method="post" id="admittedForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control" name="company" />
                    </div>
                    <div class="form-group">
                        <label>Representative Name</label>
                        <input type="text" class="form-control" name="bidder" />
                    </div>
                    <div class="form-group">
                        <label>Contact Information</label>
                        <input type="text" class="form-control" name="contact" />
                    </div>
                    <div class="form-group">
                        <label>Financial Files</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="financial_file" name="financial_file">
                            <label class="custom-file-label" for="customFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Technical and Eligibility Files</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="technical_file" name="technical_file">
                            <label class="custom-file-label" for="customFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Select Items:</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    <input type="checkbox" name="items[]" id=""> Item 1
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <input type="checkbox" name="items[]" id=""> Item 2
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <input type="checkbox" name="items[]" id=""> Item 3
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <input type="checkbox" name="items[]" id=""> Item 4
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>ABC</label>
                        <input type="number" class="form-control" name="ABC" />
                    </div>
                    <div class="alert alert-danger" style="font-size: 0.8em">
                        <em>(Note: Please put password on the archived documents.)</em>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
