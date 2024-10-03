<?php

namespace App\Services;

use App\Models\KeyRole;
use Illuminate\Http\Request;

class KeyRoleService
{
    public function insertKeyRole(Request $request)
    {
        // TODO it should come from separate validator service class
        $data = $request->validate([
            'name' => 'required|unique:key_roles|max:255',
            'priority' => 'required|integer',
            'status' => 'required|bool'
        ]);

        $keyRole = $request->user()->keyRoles()->create($data);
        return $keyRole;
    }
}
