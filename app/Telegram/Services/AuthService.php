<?php

namespace App\Telegram\Services;

use App\Services\TgUserService;
use SergiX44\Nutgram\Nutgram;

class AuthService
{
    public function __construct(
        private readonly TgUserService $tg_user_service
    )
    {
    }

    public function authUser(Nutgram $bot): int
    {
        $user_id = $bot->userId();
        $this->tg_user_service->createOrFind($user_id);
        return $user_id;
    }
}
