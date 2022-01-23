<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">
        {{ empty($purchaseTransaction) ? 'Create' : 'Edit' }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if ( empty($purchaseTransaction) )
        <form action="{{ route('purchase-transaction.store') }}" method="post" id="editor-purchase-transaction-form">
    @else
        <form action="{{ url('purchase-transaction/'.$purchaseTransaction->id) }}" method="post" id="editor-purchase-transaction-form">
        @method('PATCH')
    @endif
        @csrf
            <div class="form-group">
                <label for="">Customer</label>
                <select name="customer_id" class="form-control" id="customer_id">
                    <option value="">- PILIH -</option>
                    @foreach ($customers as $customer)
                        @if (empty($purchaseTransaction))
                            <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : null }}>{{ $customer->name }}</option>
                        @else
                            <option value="{{ $customer->id }}" {{ old('customer_id', $purchaseTransaction->customer_id) == $customer->id ? 'selected' : null }}>{{ $customer->name }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="text-danger error-text customer_id_error"></span>
            </div>
            <div class="form-group">
                <label for="">Product</label>
                <select name="product_id" class="form-control" id="product_id">
                    <option value="">- PILIH -</option>
                    @foreach ($products as $product)
                        @if (empty($purchaseTransaction))
                            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : null }}>{{ $product->name }}</option>
                        @else
                            <option value="{{ $product->id }}" {{ old('product_id', $purchaseTransaction->product_id) == $product->id ? 'selected' : null }}>{{ $product->name }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="text-danger error-text product_id_error"></span>
            </div>
            {{-- <div class="form-group">
                <label for="">Total</label>
                <input type="number" class="form-control" name="total" placeholder="Enter Total" @if ( !empty($product) ) value="{{ $product->stock }}" @endif>
            </div>
            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-block btn-success">
                    <span class="submit" role="status" aria-hidden="true"></span> Save Changes
                </button>
            </div> --}}
        </form>
</div>
<script>
    $(function() {
        $('#editor-purchase-transaction-form').on('submit', function(event) {
            event.preventDefault();
            let form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                    } else {
                        $('.modalPurchaseTransaction').modal('hide');
                        $('.modalPurchaseTransaction').find('form')[0].reset();
                        toastr.success(data.msg);
                        submitted = true;
                        autoReload = table.cell(this);
                        autoReload.data( autoReload.data() + 1 ).draw();
                    }
                }
            });
        });
    });
</script>
