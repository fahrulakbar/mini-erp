<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $fillable = ['id_po','no_so', 'nama_sup', 'alamat_sup', 'status_penerimaan', 'tanggal_diterima', 'id_barang', 'qty_barang'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->no_penerimaan = IdGenerator::generate(['table' => 'penerimaans', 'field' => 'no_penerimaan', 'length' => 9, 'prefix' => 'PE-']);
        });
    }

    public function barang()
    {
        return $this->belongsTo(Inventory::class, 'id_barang');
    }

    public function purchase()
    {
        return $this->belongsTo(PurchaseOrder::class, 'id_po');
    }
    
}
