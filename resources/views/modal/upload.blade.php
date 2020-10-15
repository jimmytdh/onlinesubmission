<div class="modal" tabindex="-1" role="dialog" id="upload_financial">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Upload Financial Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/upload/financial/'.$info->id) }}" method="post" id="financialForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" accept=".zip,.rar,.7zip" class="custom-file-input" id="financial" name="file" required>
                            <label class="custom-file-label" for="customFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="alert alert-danger" style="font-size: 0.8em">
                        <em>NOTE: Make sure to put password on uploaded documents.</em>
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

<div class="modal" tabindex="-1" role="dialog" id="upload_technical">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Upload Technical Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/upload/technical/'.$info->id) }}" method="post" id="technicalForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" accept=".zip,.rar,.7zip" class="custom-file-input" id="technical_file" name="file" required>
                            <label class="custom-file-label" for="customFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="alert alert-danger" style="font-size: 0.8em">
                        <em>NOTE: Make sure to put password on uploaded documents.</em>
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


<div class="modal" tabindex="-1" role="dialog" id="upload_mfinancial">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Upload Modified Financial Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/upload/mfinancial/'.$info->id) }}" method="post" id="mfinancialForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" accept=".zip,.rar,.7zip" class="custom-file-input" name="file" required>
                            <label class="custom-file-label" for="customFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="alert alert-danger" style="font-size: 0.8em">
                        <em>NOTE: Make sure to put password on uploaded documents.</em>
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

<div class="modal" tabindex="-1" role="dialog" id="upload_mtechnical">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Upload Modified Technical Document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/upload/mtechnical/'.$info->id) }}" method="post" id="mtechnicalForm" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <div class="custom-file">
                            <input type="file" accept=".zip,.rar,.7zip" class="custom-file-input" name="file" required>
                            <label class="custom-file-label" for="customFile">Choose file...</label>
                        </div>
                    </div>
                    <div class="alert alert-danger" style="font-size: 0.8em">
                        <em>NOTE: Make sure to put password on uploaded documents.</em>
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










