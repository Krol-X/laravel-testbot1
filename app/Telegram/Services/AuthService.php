<?php

namespace App\Telegram\Services;

use App\Models\TgUser;
use App\Services\TgUserService;
use SergiX44\Nutgram\Nutgram;

class AuthService
{
    public function __construct(
        private readonly TgUserService $tg_user_service
    )
    {
    }

    public function authUser(Nutgram $bot): TgUser
    {
        $user_data = $bot->user();

        $user = $this->tg_user_service->createOrFind($user_data);
        return $user;
    }
}
