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

