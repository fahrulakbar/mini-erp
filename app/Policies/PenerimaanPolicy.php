<?php

namespace App\Policies;

use App\Models\Penerimaan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PenerimaanPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function liatData(User $user)
    {
        if ($user->role == User::ROLE_ADMIN_PURCHASE || $user->role == User::ROLE_SALES) {
            return Response::deny('Akses ditolak');
        }

        return Response::allow();
        // return $user->role == User::ROLE_SUPERADMIN || $user->role == User::ROLE_ADMIN_WAREHOUSE;
    }
}
