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
        // TgUser::paginate(10)
        return new TgUserCollection(TgUser::all());
    }

    public function store(Request $request): TgUserResource|JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required|integer',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $user = TgUser::create($request->only([
            'id', 'firstname', 'lastname', 'username'
        ]));
        return new TgUserResource($user);
    }

    public function show(TgUser $user): TgUserResource
    {
        return new TgUserResource($user);
    }

    public function update(Request $request, TgUser $user): TgUserResource|JsonResponse
    {
        $validated = Validator::make($request->all(), [
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
            'username' => 'sometimes|string|max:255'
        ]);

        if ($validated->fails()) {
            return response()->json($validated->errors(), 422);
        }

        $user->update($request->only([
            'firstname', 'lastname', 'username',
        ]));
        return new TgUserResource($user);
    }

    public function destroy(TgUser $user): JsonResponse
    {
        $user->delete();
        // 204 No Content
        return response()->json(null, 204);
    }
}
