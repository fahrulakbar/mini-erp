@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Tambah Barang
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="myTable" class="display">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Stok Tersedia</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventory as $row )
                                    <tr>
                                        <td>{{ $row->nama_barang }}</td>
                                        <td>{{ $row->qty_barang }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <a class="btn btn-success" id="btn-edit-post" data-id="{{ $row->id }}" href="#">Edit</a>
                                                </div>

                                                <div class="col-md-6">
                                                    <a class="btn btn-danger" href="{{ route('inventory.destroy',$row->id) }}">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach,
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('inventory.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" id="exampleFormControlInput1">
                        @error('nama_barang')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">QTY</label>
                        <input type="number" name="qty_barang" class="form-control" id="exampleFormControlInput1">
                        @error('qty_barang')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editLabel">Update Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" id="nama_barang">
                        @error('nama_barang')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="hidden" id="id">
                    <div class="mb-3">
                        <label for="qty_barang" class="form-label">QTY</label>
                        <input type="number" name="qty_barang" class="form-control" id="qty_barang">
                        @error('qty_barang')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="update">Update Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')

<script>
    let table = new DataTable('#myTable', {
        responsive: true
    });

    //button create post event
    $('body').on('click', '#btn-edit-post', function() {
        let post_id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
            url: `/inventory/${post_id}`,
            type: "GET",
            cache: false,
            success: function(response) {

                $('#id').val(response.id);
                $('#nama_barang').val(response.nama_barang);
                $('#qty_barang').val(response.qty_barang);
                // $('#content-edit').val(response.data.content);

                //open modal
                $('#edit').modal('show');
            }
        });
    });

    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let id = $('#id').val();
        console.log(id);
        let nama_barang = $('#nama_barang').val();
        let qty_barang   = $('#qty_barang').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({
            url: `/inventory/update/${id}`,
            type: "GET",
            cache: false,
            data: {
                "nama_barang": nama_barang,
                "qty_barang": qty_barang,
                "_token": token
            },
            success:function(response){
                console.log(response);
                //close modal
                location.reload();
            },

        });
    });
</script>
@endsection