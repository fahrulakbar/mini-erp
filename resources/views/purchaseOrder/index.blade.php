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
                                Tambah Purchase Order
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Purchase Order</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('purchase.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="no_so" class="form-label">Sales Order</label>
                                                    <select class="form-select" name="id_so" id="no_so" aria-label="Default select example">
                                                        @foreach ($salesOrder as $item)
                                                        <option value="{{$item->id}}">{{$item->no_so}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('id_so')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama Customer</label>
                                                    <input type="text" name="nama_customer" class="form-control" id="exampleFormControlInput1">
                                                    @error('nama_customer')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Alamat Customer</label>
                                                    <input type="text" name="alamat_customer" class="form-control" id="exampleFormControlInput1">
                                                    @error('alamat_customer')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                                                    <input type="date" name="date_po" class="form-control" id="exampleFormControlInput1">
                                                    @error('date_po')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                                                        <select class="form-select" id="barang" name="id_barang" aria-label="Default select example">
                                                            @foreach ($barang as $item)
                                                            <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="qty" class="form-label">QTY</label>
                                                        <input type="number" name="qty_barang" class="form-select" id="qty" value="0">
                                                    </div>
                                                </div>
                                                <div id="divTxt"></div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Tambah Barang</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">No PO</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Alamat Customer</th>
                                        <th scope="col">Date PO</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseOrder as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->no_po }}</td>
                                        <td>{{ $item->nama_customer }}</td>
                                        <td>{{ $item->alamat_customer }}</td>
                                        <td>{{ $item->date_po}}</td>
                                        <td>{{ $item->barang->nama_barang}}</td>
                                        <td>{{ $item->qty_barang}}</td>
                                        <td>
                                            @if ($item->status_po == 0)
                                            <a href="{{ route('purchase.update',$item->id) }}" type="button" class="btn btn-success">Approve</a>
                                            @else
                                            <p>Purchase Order Telah di approve</p>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    id = $('#no_so').val();
    $.ajax({
        url: `/sales-order/${id}`,
        type: "GET",
        cache: false,
        success: function(response) {
            $("#barang").val(response.id_barang).change();
            $("#qty").val(response.qty_barang).change();
        }
    });

    $('#no_so').on('change', function() {
        id = this.value;

        $.ajax({
            url: `/sales-order/${id}`,
            type: "GET",
            cache: false,
            success:function(response){
                $("#barang").val(response.id_barang).change();
                $("#qty").val(response.qty_barang).change();
            }
        });
    });
</script>
@endsection