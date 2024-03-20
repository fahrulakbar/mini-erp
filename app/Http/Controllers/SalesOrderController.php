<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalesOrder\CreateSalesOrder;
use App\Models\Inventory;
use App\Models\SalesOrder;

class SalesOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('liatData', SalesOrder::class);

        $salesOrder = SalesOrder::with('barang')->get();
        $barang = Inventory::select('id', 'nama_barang')->get();

        return view('salesOrder.index', [
            'salesOrder' => $salesOrder,
            'barang' => $barang
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSalesOrder $request)
    {
        $this->authorize('liatData', SalesOrder::class);

        SalesOrder::create($request->all() + [
            'status_so' => 0
        ]);

        return redirect('/sales-order')->with('message', 'Berhasil menambahkan sales order baru');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(string $id)
    {
        $this->authorize('liatData', SalesOrder::class);
        
        $salesOrder = SalesOrder::find($id);

        return $salesOrder;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $this->authorize('liatData', SalesOrder::class);

        $salesOrder = SalesOrder::find($id);
        $salesOrder->update([
            'status_so' => 1
        ]);

        return redirect('/sales-order')->with('message', 'Berhasil Approve Sales Order');
    }
}
