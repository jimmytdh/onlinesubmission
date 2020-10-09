<div class="form-group">
    <label>Company</label>
    <input type="text" class="form-control" name="company" required />
</div>
<div class="form-group">
    <label>Representative Name</label>
    <input type="text" class="form-control" name="bidder" required />
</div>
<div class="form-group">
    <label>Contact Information</label>
    <input type="text" class="form-control" name="contact" required />
</div>
<div class="form-group">
    <label>Financial Files</label>
    <div class="custom-file">
        <input type="file" accept=".zip,.rar" class="custom-file-input" id="financial_file" name="financial_file" required>
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
<div class="form-group">
    <label>Select Items:</label>
    <div class="row">
        @foreach($items as $i)
        <div class="col-sm-12">
            <label>
                <input type="checkbox" name="items[]" value="{{ $i->id }}"> {{ $i->item_no }}. {{ $i->name }}
            </label>
        </div>
        @endforeach
    </div>
</div>
<div class="alert alert-danger" style="font-size: 0.8em">
    <em>NOTE: Make sure to put password on uploaded documents.</em>
</div>
