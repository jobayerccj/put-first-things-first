<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\KeyRole;
use App\Services\KeyRoleService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class KeyRoleController extends Controller
{
    public function __construct(protected KeyRoleService $keyRoleService)
    {
    }

    public function index()
    {
        return KeyRole::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->keyRoleService->insertKeyRole($request);
    }

    /**
     * Display the specified resource.
     *
     * @param KeyRole $keyRole
     */
    public function show(KeyRole $keyRole)
    {
        return $keyRole;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param KeyRole $keyRole
     */
    public function update(Request $request, KeyRole $keyRole)
    {
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('key_roles')->ignore($keyRole->id)
            ],
            'priority' => 'required|integer',
            'status' => 'required|bool'
        ]);

        $keyRole->update($data);
        return $keyRole;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param KeyRole $keyRole
     */
    public function destroy(KeyRole $keyRole)
    {
        $keyRole->delete();
        return ['message' => 'The Key Roles has been deleted'];
    }
}
