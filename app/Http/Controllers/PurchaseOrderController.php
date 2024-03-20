<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrder\CreatePurchaseOrderRequest;
use App\Models\Inventory;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
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
        $this->authorize('liatData', PurchaseOrder::class);

        $purchaseOrder = PurchaseOrder::with('barang')->get();
        $barang = Inventory::select('id', 'nama_barang')->get();
        $salesOrder = SalesOrder::select('id', 'no_so')->where('status_so', 1)->whereDoesntHave('purchase')->get();

        return view('purchaseOrder.index', [
            'purchaseOrder' => $purchaseOrder,
            'barang' => $barang,
            'salesOrder' => $salesOrder
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePurchaseOrderRequest $request)
    {
        $this->authorize('liatData', PurchaseOrder::class);

        PurchaseOrder::create($request->all() + [
            'status_po' => 0
        ]);

        return redirect('/purchase-order')->with('message', 'Berhasil Menambahkan Purchase Order');;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(string $id)
    {
        $this->authorize('liatData', PurchaseOrder::class);

        $purchaseOrder = PurchaseOrder::with('sales')->where('id',$id)->firstOrfail();

        return $purchaseOrder;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        $this->authorize('liatData', PurchaseOrder::class);

        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseOrder->update([
            'status_po' => 1
        ]);

        return redirect('/purchase-order')->with('message', 'Berhasil Approve Purchase Order');;
    }
}
