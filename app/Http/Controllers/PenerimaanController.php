<?php

namespace App\Http\Controllers;

use App\Http\Requests\Penerimaan\CreatePenerimaanRequest;
use App\Models\Inventory;
use App\Models\Penerimaan;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
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
        $this->authorize('liatData', Penerimaan::class);

        $penerimaan = Penerimaan::with('purchase')->get();
        $barang = Inventory::select('id', 'nama_barang')->get();
        $purchaseOrder = PurchaseOrder::select('id', 'no_po', 'id_so')->with('sales')->where('status_po', 1)->whereDoesntHave('penerimaan')->get();

        return view('penerimaan.index', [
            'purchaseOrder' => $purchaseOrder,
            'barang' => $barang,
            'penerimaan' => $penerimaan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePenerimaanRequest $request)
    {
        $this->authorize('liatData', Penerimaan::class);
        
        Penerimaan::create($request->all() + [
            'status_penerimaan' => 0
        ]);

        return redirect('/penerimaan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(string $id)
    {
        $this->authorize('liatData', Penerimaan::class);

        $purchaseOrder = Penerimaan::where('id', $id)->firstOrfail();

        return $purchaseOrder;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $this->authorize('liatData', Penerimaan::class);

        $penerimaan = Penerimaan::find($id);
        $penerimaan->update([
            'status_penerimaan' => 1
        ]);

        $penerimaan->barang()->update([
            'qty_barang' => $penerimaan->barang->qty_barang + $penerimaan->qty_barang
        ]);

        return redirect('/penerimaan')->with('message', 'Berhasil Approve Penerimaan Barang');;
    }
}
