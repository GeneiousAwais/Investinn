<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypeController extends Controller
{
    public function index()
    {
        $data = UserType::where('is_active', 1)->get();
        return response()->json([
            'status' => 200,
            'message' => 'User types fetched',
            'data' => $data
        ], 200);
    }
}
