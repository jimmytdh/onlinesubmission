<div class="modal" tabindex="-1" role="dialog" id="convert">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Name of Supply</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/supply/convert/') }}" method="post" id="admittedForm" onsubmit="myButton.disabled = true; return true;">
                {{ csrf_field() }}
                <div class="modal-body">
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th colspan="3" class="bg-dark text-white">Ratio</th>
                        </tr>
                        <tr>
                            <th class="text-danger align-middle" rowspan="2">1 {{ $unit }}</th>
                            <td rowspan="2" class="text-center bg-warning align-middle">
                                =
                            </td>
                            <td>
                                <input type="number" min="1" value="1" class="form-control form-control-sm" name="qty">
                            </td>
                        </tr>
                        <tr>
                            <th width="45%">
                                <select name="unit" class="form-control form-control-sm" required>
                                    <option>pcs</option>
                                    <option>btl</option>
                                    <option>box</option>
                                </select>
                            </th>
                        </tr>
                    </table>
                    <table class="table table-sm table-bordered">
                        <tr>
                            <th colspan="3" class="bg-dark text-white">Qty</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="number" min="1" value="1" class="form-control form-control-sm" name="qty">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="myButton">Convert</button>
                </div>
            </form>
        </div>
    </div>
</div>
