<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = ['no_po','id_so', 'nama_customer', 'alamat_customer', 'status_po', 'date_po', 'id_barang', 'qty_barang'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->no_po = IdGenerator::generate(['table' => 'purchase_orders', 'field' => 'no_po', 'length' => 9, 'prefix' => 'PO-']);
        });
    }

    public function sales()
    {
        return $this->belongsTo(SalesOrder::class, 'id_so');
    }

    public function barang()
    {
        return $this->belongsTo(Inventory::class, 'id_barang');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_po');
    }
    
}
