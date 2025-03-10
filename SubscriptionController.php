<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    /**
     * Create a new subscription
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plan_id' => 'required|exists:plans,id',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = auth()->user();
        
        // Check if user already has an active subscription
        if ($user->hasActiveSubscription()) {
            return response()->json(['error' => 'User already has an active subscription'], 400);
        }

        // Create new subscription
        $subscription = new Subscription();
        $subscription->user_id = $user->id;
        $subscription->plan_id = $request->plan_id;
        $subscription->payment_method = $request->payment_method;
        $subscription->status = 'active';
        $subscription->start_date = now();
        $subscription->end_date = now()->addMonth();
        $subscription->save();

        return response()->json([
            'success' => true,
            'data' => $subscription
        ], 201);
    }

    /**
     * Cancel a subscription
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancel(Request $request)
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription();

        if (!$subscription) {
            return response()->json(['error' => 'No active subscription found'], 404);
        }

        $subscription->status = 'cancelled';
        $subscription->cancelled_at = now();
        $subscription->save();

        return response()->json([
            'success' => true,
            'message' => 'Subscription cancelled successfully'
        ]);
    }

    /**
     * Get user's current subscription
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentSubscription(Request $request)
    {
        $user = auth()->user();
        $subscription = $user->activeSubscription();

        if (!$subscription) {
            return response()->json(['error' => 'No active subscription found'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $subscription->load('plan')
        ]);
    }
}