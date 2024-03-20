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
                                        <form action="{{ route('penerimaan.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="no_so" class="form-label">Purchase Order</label>
                                                    <select class="form-select" name="id_po" id="no_po" aria-label="Default select example">
                                                        @foreach ($purchaseOrder as $item)
                                                        <option value="{{$item->id}}">{{$item->no_po}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('no_po')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Nama sup</label>
                                                    <input type="text" name="nama_sup" class="form-control" id="exampleFormControlInput1">
                                                    @error('nama_sup')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Alamat sup</label>
                                                    <input type="text" name="alamat_sup" class="form-control" id="exampleFormControlInput1">
                                                    @error('alamat_sup')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Tanggal diterima</label>
                                                    <input type="date" name="tanggal_diterima" class="form-control" id="exampleFormControlInput1">
                                                    @error('tanggal_diterima')
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
                                                    <input type="hidden" name="no_so" id='no_so'>
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
                                        <th scope="col">No so</th>
                                        <th scope="col">No po</th>
                                        <th scope="col">No Penerimaan</th>
                                        <th scope="col">Nama sup</th>
                                        <th scope="col">Alamat sup</th>
                                        <th scope="col">Tanggal Diterima</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">qty</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penerimaan as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->no_so}}</td>
                                        <td>{{ $item->purchase->no_po}}</td>
                                        <td>{{ $item->no_penerimaan }}</td>
                                        <td>{{ $item->nama_sup }}</td>
                                        <td>{{ $item->alamat_sup }}</td>
                                        <td>{{ $item->tanggal_diterima}}</td>
                                        <td>{{ $item->barang->nama_barang}}</td>
                                        <td>{{ $item->qty_barang}}</td>
                                        <td>
                                            @if ($item->status_penerimaan == 0)
                                            <a href="{{ route('penerimaan.update',$item->id) }}" type="button" class="btn btn-success">Approve</a>
                                            @else
                                            <p>Penerimaan Telah di approve</p>
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
    id = $('#no_po').val();
    $.ajax({
        url: `/purchase-order/${id}`,
        type: "GET",
        cache: false,
        success: function(response) {
            $("#no_so").val(response.sales.no_so).change();
            $("#barang").val(response.id_barang).change();
            $("#qty").val(response.qty_barang).change();
        }
    });

    $('#no_po').on('change', function() {
        id = this.value;

        $.ajax({
            url: `/purchase-order/${id}`,
            type: "GET",
            cache: false,
            success: function(response) {

            $("#no_so").val(response.sales.no_so).change();
                $("#barang").val(response.id_barang).change();
                $("#qty").val(response.qty_barang).change();
            }
        });
    });
</script>
@endsection