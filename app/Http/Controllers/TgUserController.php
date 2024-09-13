<?php

namespace App\Http\Controllers;

use App\Models\TgUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TgUserController extends Controller
{
    public function list(Request $request): JsonResponse
    {
        Log::warning('list');
        $users = TgUser::all();
        $resp = $users->map(fn($it) => [
            'id' => $it['id'],
            'created_at' => $it['created_at']
        ]);
        return response()->json([
            'status' => 'ok',
            'data' => $resp
        ]);
    }
}
