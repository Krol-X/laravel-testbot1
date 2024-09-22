<?php

namespace App\Http\Controllers;

use App\Http\Resources\TgUserCollection;
use App\Http\Resources\TgUserResource;
use App\Models\TgUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TgUserController extends Controller
{
    public function index()
    {
        return new TgUserCollection(TgUser::paginate(10));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $user = TgUser::create($request);
        return new TgUserResource($user);
    }

    public function show(TgUser $user)
    {
        return new TgUserResource($user);
    }

    public function update(Request $request, TgUser $user)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $user->update($request->only(['name']));
        return new TgUserResource($user);
    }

    public function destroy(TgUser $user): JsonResponse
    {
        $user->delete();
        // 204 No Content
        return response()->json(null, 204);
    }
}
