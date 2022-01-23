<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">
        {{ empty($customer) ? 'Create' : 'Edit' }}
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    @if ( empty($customer) )
        <form action="{{ route('customer.store') }}" method="post" id="editor-customer-form">
    @else
        <form action="{{ url('customer/'.$customer->id) }}" method="post" id="editor-customer-form">
        @method('PATCH')
    @endif
        @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" @if ( !empty($customer) ) value="{{ $customer->name }}" @endif>
                <span class="text-danger error-text name_error"></span>
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" class="form-control" id="address" cols="30" rows="10" placeholder="address">@if ( !empty($customer) ) {{ $customer->address }} @endif</textarea>
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
        $('#editor-customer-form').on('submit', function(event) {
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
                        $('.modalCustomer').modal('hide');
                        $('.modalCustomer').find('form')[0].reset();
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
