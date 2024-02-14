<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class EditRole extends Component
{
    public function render()
    {
        // $all_permissions = Permission::whereNot('name', 'manage all')->get();
        $roles = Role::whereNot('name', 'Admin')->get();
        return view('livewire.edit-role', compact(
            'roles',
        ));
    }
}
