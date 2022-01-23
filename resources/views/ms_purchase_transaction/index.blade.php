@extends('main')

@section('content')
    <h1>Purchase Transaction</h1>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success btn-sm" id="create">Create</button><br><hr>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th class="serial">#</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade modalPurchaseTransaction" data-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    let submitted = false;
    let table;
    let autoReload;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        // SHOW ALL DATA >>>>>>>>>>>>>>>>>>
        let sendData = {
            processing  : true,
            serverSide  : true,
            scroolX     : true,
            autoWidth   : true,
            columns     : [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'customer', name: 'customer.name'},
                {data: 'product', name: 'product.name'},
                {data: 'date', name: 'date'},
                {data: 'total', name: 'total'},
                {
                    data: 'action',
                    name: 'action',
                    type: 'html',
                    orderable: false,
                    searchabe: false
                },
            ]
        };
        loadData();

        function loadData() {
            sendData.ajax = "{{ route('purchase-transaction.index') }}";
            table = $('#datatable').DataTable(sendData);
        }
        // SHOW ALL DATA >>>>>>>>>>>>>>>>>>

        // CREATE >>>>>>>>>>>>>>>>>>
        $(document).on('click', '#create', function() {
            $.get('{{ route("editor.purchase.transaction") }}', function(data) {
                $('.modalPurchaseTransaction').find('.modal-content').html(data);
                $('.modalPurchaseTransaction').modal('show');
            });
        });
        $('.modalPurchaseTransaction').on('shown.bs.modal', function(event) {
            $('input[name="name"]').focus();
        });
        $('.modalPurchaseTransaction').on('hidden.bs.modal', function(event) {
            if (submitted) {
                submitted = false;
            }
        });
        // CREATE >>>>>>>>>>>>>>>>>>

        // EDIT >>>>>>>>>>>>>>>>>>
        $(document).on('click', '#edit', function() {
            let purchaseTransactionId = $(this).data('id');
            $.get('{{ route("editor.purchase.transaction") }}', {purchaseTransactionId: purchaseTransactionId}, function(data) {
                $('.modalPurchaseTransaction').find('.modal-content').html(data);
                $('.modalPurchaseTransaction').modal('show');
            });
        });
        // EDIT >>>>>>>>>>>>>>>>>>

        // DELETE >>>>>>>>>>>>>>>>>>
        $(document).on('click', '#delete', function() {
            let purchaseTransactionId = $(this).data('id');
            swal.fire({
                title: 'Are you sure?',
                html: 'You want to <b>delete</b> this Sub Menu',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: '#556ee6',
                confirmButtonColor: '#d33',
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: "{{ url('purchase-transaction') }}" + '/' + purchaseTransactionId,
                        data: {
                            purchaseTransactionId : purchaseTransactionId,
                        },
                        success: function(data) {
                            toastr.success(data.msg);
                            autoReload = table.cell( this );
                            autoReload.data( autoReload.data() + 1 ).draw();
                        }
                    });
                }
            });
        });
        // DELETE >>>>>>>>>>>>>>>>>>
    });
</script>
@endsection
