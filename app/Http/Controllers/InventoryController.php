<?php

namespace App\Http\Controllers;

use App\Http\Requests\Inventory\CreateInventoryRequest;
use App\Http\Requests\Inventory\UpdateInventoryRequest;
use App\Models\Inventory;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
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
        $this->authorize('liatData', Inventory::class);

        $inventory = Inventory::get();

        return view('home', ['inventory' => $inventory]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateInventoryRequest $request)
    {
        $this->authorize('liatData', Inventory::class);

        Inventory::create($request->validated());

        return redirect('/home')->with('message', 'Berhasil Menambahkan Barang');;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('liatData', Inventory::class);

        $inventory = Inventory::findOrFail($id);

        return $inventory;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, string $id)
    {
        $this->authorize('liatData', Inventory::class);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->validated());

        return json_encode([
            'response' => 'succes update barang'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('liatData', Inventory::class);

        $inventory = Inventory::find($id);
        $inventory->delete();

        return redirect('/home')->with('message', 'Berhasil Menghapus Barang');;
    }
}
