<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">
        {{ empty($product) ? 'Create' : 'Edit' }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if ( empty($product) )
        <form action="{{ route('product.store') }}" method="post" id="editor-product-form">
    @else
        <form action="{{ url('product/'.$product->id) }}" method="post" id="editor-product-form">
        @method('PATCH')
    @endif
        @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" @if ( !empty($product) ) value="{{ $product->name }}" @endif>
                <span class="text-danger error-text name_error"></span>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10" placeholder="description">@if ( !empty($product) ){{ $product->description }}@endif</textarea>
                <span class="text-danger error-text description_error"></span>
            </div>
            <div class="form-group">
                <label for="">Harga Produk</label>
                <input type="number" class="form-control" name="price" placeholder="Enter price" @if ( !empty($product) ) value="{{ $product->price }}" @endif>
                <span class="text-danger error-text price_error"></span>
            </div>
            <div class="form-group">
                <label for="">Stock</label>
                <input type="number" class="form-control" name="stock" placeholder="Enter stock" @if ( !empty($product) ) value="{{ $product->stock }}" @endif>
                <span class="text-danger error-text stock_error"></span>
            </div>
            <div class="form-group">
                <label for="">Category Product</label>
                <select name="category_product_id" class="form-control" id="category_product_id">
                    <option value="">- PILIH -</option>
                    @foreach ($categoryProduct as $item)
                        @if (empty($product))
                            <option value="{{ $item->id }}" {{ old('category_product_id') == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                        @else
                            <option value="{{ $item->id }}" {{ old('category_product_id', $product->category_product_id) == $item->id ? 'selected' : null }}>{{ $item->name }}</option>
                        @endif
                    @endforeach
                </select>
                <span class="text-danger error-text category_product_id_error"></span>
            </div>
            <div class="form-group">
                <button type="submit" id="submit" class="btn btn-block btn-success">
                    <span class="submit" role="status" aria-hidden="true"></span> Save Changes
                </button>
            </div>
        </form>
</div>
<script>
    $(function() {
        $('#editor-product-form').on('submit', function(event) {
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
                        $('.modalProduct').modal('hide');
                        $('.modalProduct').find('form')[0].reset();
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
