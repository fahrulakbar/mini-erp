<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Inventory;
use App\Models\Penerimaan;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Policies\InventoryPolicy;
use App\Policies\PenerimaanPolicy;
use App\Policies\PurchaseOrderPolicy;
use App\Policies\SalesOrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Inventory::class => InventoryPolicy::class,
        SalesOrder::class => SalesOrderPolicy::class,
        PurchaseOrder::class => PurchaseOrderPolicy::class,
        Penerimaan::class => PenerimaanPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
