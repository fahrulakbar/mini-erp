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
                                Tambah Sales Order
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Sales Order</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('sales.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
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
                                                    <input type="date" name="date_so" class="form-control" id="exampleFormControlInput1">
                                                    @error('date_so')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                                                        <select class="form-select" name="id_barang" aria-label="Default select example">
                                                            @foreach ($barang as $item)
                                                            <option value="{{$item->id}}">{{$item->nama_barang}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="exampleFormControlInput1" class="form-label">QTY</label>
                                                        <input type="number" name="qty_barang" class="form-select" id="exampleFormControlInput1" value="0">
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
                                        <th scope="col">No so</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Alamat Customer</th>
                                        <th scope="col">Date so</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salesOrder as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->no_so }}</td>
                                        <td>{{ $item->nama_customer }}</td>
                                        <td>{{ $item->alamat_customer }}</td>
                                        <td>{{ $item->date_so}}</td>
                                        <td>{{ $item->barang->nama_barang}}</td>
                                        <td>{{ $item->qty_barang}}</td>
                                        <td>
                                            @if ($item->status_so == 0)
                                            <a href="{{ route('sales.update',$item->id) }}" type="button" class="btn btn-success">Approve</a>
                                            @else
                                            <p>Sales Order Telah di approve</p>
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