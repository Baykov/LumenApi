<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CompaniesController extends Controller
{
    /**
     * Get all user companies
     *
     * @return JsonResponse
     */
    public function getUserCompanies(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Unauthorized'], 401);
        return response()->json($user->companies);
    }

    /**
     * Create user company item
     *
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postUserCompanies(Request $request): JsonResponse
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $this->validate(
                $request, [
                'title' => 'required',
                'phone' => 'required',
                'description' => 'required',
            ]
            );
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), 422);
        }

        $data = $request->all();
        $data['user_id'] = $user->id;

        $model = Company::create($data);

        return response()->json($model, 201);
    }

}
