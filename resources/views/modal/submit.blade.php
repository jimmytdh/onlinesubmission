<div class="modal" tabindex="-1" role="dialog" id="submit_modal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Submit Bid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/submit') }}" method="post" id="submitForm" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                    <button type="submit" class="btn btn-success submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
