<?php

namespace App\Services;

use App\Models\TgUser;

class TgUserService
{
    public function createOrFind($user_data): TgUser
    {
        $user = TgUser::find($user_data->id);
        if ($user === null) {
            $user = TgUser::create([
                'id' => $user_data->id,
                'firstname' => $user_data->first_name,
                'lastname' => $user_data?->last_name ?? '',
                'username' => $user_data->username
            ]);
        }
        return $user;
    }
}
