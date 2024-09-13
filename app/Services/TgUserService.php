<?php

namespace App\Services;

use App\Models\TgUser;

class TgUserService
{
    public function createOrFind(string $id): TgUser
    {
        $user = TgUser::find($id);
        if ($user === null) {
            $user = TgUser::create([
                'id' => $id
            ]);
        }
        return $user;
    }
}
