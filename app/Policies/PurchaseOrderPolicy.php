<?php

namespace App\Policies;

use App\Models\PurchaseOrder;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PurchaseOrderPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function liatData(User $user)
    {
        if ($user->role == User::ROLE_ADMIN_WAREHOUSE || $user->role == User::ROLE_SALES) {
            return Response::deny('Akses ditolak');
        }

        return Response::allow();
        // return $user->role == User::ROLE_SUPERADMIN || $user->role == User::ROLE_ADMIN_WAREHOUSE;
    }
}
