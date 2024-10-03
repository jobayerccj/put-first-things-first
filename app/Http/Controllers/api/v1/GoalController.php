<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Services\GoalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class GoalController extends Controller
{
    public function __construct(protected GoalService $goalService)
    {
    }

    public function index()
    {
        return Goal::where('user_id', Auth::id())->get(['name', 'status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     */
    public function store(Request $request)
    {
        return $this->goalService->insertGoal($request);
    }

    /**
     * Display the specified resource.
     *
     * @param Goal $goal
     */
    public function show(Goal $goal)
    {
        return $goal;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Goal $goal
     */
    public function update(Request $request, Goal $goal)
    {
        // TODO it should be moved to service
        $data = $request->validate([
            'name' => [
                'required',
                Rule::unique('goals')->where(function ($query) {
                    return $query->where('user_id', Auth::id());
                })->ignore($goal->id)
            ],
            'priority' => 'required|integer',
            'status' => 'required|bool'
        ]);

        if (Auth::id() !== $goal->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $goal->update($data);
        return $goal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Goal $goal
     */
    public function destroy(Goal $goal)
    {
        $goal->delete();
        return ['message' => 'The Key Roles has been deleted'];
    }
}
