<table class="table-sm table table-hover">
    <thead>
    <tr>
        <th>Item</th>
        <th class="text-right">Amount</th>
        <th class="text-center">Qty</th>
    </tr>
    </thead>
    <tbody>
    @if(count($items)>0)
        @foreach($items as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td class="text-right">{{ number_format($row->amount,2) }}</td>
            <td class="text-center">{{ number_format($row->qty) }}</td>
        </tr>
        @endforeach
    @else
        <tr>
            <td colspan="3">
                <div class="alert alert-warning">
                    <div class="text-center">
                        *** <i class="fa fa-exclamation-triangle"></i> No items available! ***
                    </div>
                </div>
            </td>
        </tr>
    @endif
    </tbody>
</table>
