<?php

namespace App\Services;

use App\Models\KeyRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GoalService
{
    public function insertGoal(Request $request)
    {
        // TODO it should come from separate validator service class
        $data = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('goals')->where(function ($query) use ($request) {
                    return $query
                        ->where('user_id', Auth::id())
                        ->where('key_role_id', $request->get('key_role_id'))
                        ;
                })
            ],
            'status' => 'required|bool',
            'key_role_id' => [
                'required',
                'integer',
                Rule::exists('key_roles', 'id'),
            ]
        ]);

        $goal = $request->user()->goals()->create($data);
        return $goal;
    }
}
