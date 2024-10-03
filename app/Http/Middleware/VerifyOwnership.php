<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $model): Response
    {
        // Assuming the route parameter contains the resource ID (e.g., 'goal' or 'id')
        $resourceId = $request->route('id'); // Adjust this to your route parameter, e.g., 'goal'

        // Retrieve the model dynamically
        $resource = app($model)->find($resourceId);

        if (!$resource || $resource->user_id !== Auth::id()) {
            // If the resource doesn't exist or doesn't belong to the user
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
