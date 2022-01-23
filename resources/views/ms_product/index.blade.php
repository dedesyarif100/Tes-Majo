@extends('main')

@section('content')
    <h1>PRODUCT</h1>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success btn-sm" id="create">Create</button><br><hr>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th class="serial">#</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th>Category Product</th>
                        <th>Images</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade modalProduct" data-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'price', name: 'price'},
                {data: 'stock', name: 'stock'},
                {data: 'category_product', name: 'category_products.name'},
                {data: 'images', name: 'images'},
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
            sendData.ajax = "{{ route('product.index') }}";
            table = $('#datatable').DataTable(sendData);
        }
        // SHOW ALL DATA >>>>>>>>>>>>>>>>>>

        // CREATE >>>>>>>>>>>>>>>>>>
        $(document).on('click', '#create', function() {
            $.get('{{ route("editor.product") }}', function(data) {
                $('.modalProduct').find('.modal-content').html(data);
                $('.modalProduct').modal('show');
            });
        });
        $('.modalProduct').on('shown.bs.modal', function(event) {
            $('input[name="name"]').focus();
        });
        $('.modalProduct').on('hidden.bs.modal', function(event) {
            if (submitted) {
                submitted = false;
            }
        });
        // CREATE >>>>>>>>>>>>>>>>>>

        // EDIT >>>>>>>>>>>>>>>>>>
        $(document).on('click', '#edit', function() {
            let productId = $(this).data('id');
            $.get('{{ route("editor.product") }}', {productId: productId}, function(data) {
                $('.modalProduct').find('.modal-content').html(data);
                $('.modalProduct').modal('show');
            });
        });
        // EDIT >>>>>>>>>>>>>>>>>>

        // DELETE >>>>>>>>>>>>>>>>>>
        $(document).on('click', '#delete', function() {
            let productId = $(this).data('id');
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
                        url: "{{ url('product') }}" + '/' + productId,
                        data: {
                            productId : productId,
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
