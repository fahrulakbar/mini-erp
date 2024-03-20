<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = ['no_so', 'nama_customer', 'alamat_customer', 'status_so', 'date_so', 'id_barang', 'qty_barang'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->no_so = IdGenerator::generate(['table' => 'sales_orders', 'field' => 'no_so', 'length' => 9, 'prefix' => 'SO-']);
        });
    }

    public function barang()
    {
        return $this->belongsTo(Inventory::class, 'id_barang');
    }

    public function purchase()
    {
        return $this->hasMany(PurchaseOrder::class, 'id_so');
    }
}
