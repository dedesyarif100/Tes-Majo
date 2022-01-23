<div class="modal-header">
    <div class="modal-title" id="exampleModalLabel">
        {{ empty($categoryProduct) ? 'Create' : 'Edit' }}
    </div>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if ( empty($categoryProduct) )
        <form action="{{ route('category-product.store') }}" method="post" id="editor-category-product-form">
    @else
        <form action="{{ url('category-product/'.$categoryProduct->id) }}" method="post" id="editor-category-product-form">
        @method('PATCH')
    @endif
        @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="name" @if (!empty($categoryProduct)) value="{{ $categoryProduct->name }}" @endif>
                <span class="text-danger error-text name_error"></span>
            </div>
            <div class="form-group">
                <label for="">Code</label>
                <input type="text" class="form-control" name="code" placeholder="code" @if (!empty($categoryProduct)) value="{{ $categoryProduct->code }}" @endif>
                <span class="text-danger error-text code_error"></span>
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
        $('#editor-category-product-form').on('submit', function(event) {
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
                        $('.modalCategoryProduct').modal('hide');
                        $('.modalCategoryProduct').find('form')[0].reset();
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
