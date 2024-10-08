<?php

namespace App\Telegram\Commands;

use App\Telegram\Services\AuthService;
use SergiX44\Nutgram\Nutgram;

class StartCommand
{
    public function __construct(
        private readonly AuthService $auth_service
    )
    {
    }

    public function __invoke(Nutgram $bot): void
    {
        $user = $this->auth_service->authUser($bot);
        $bot->sendMessage("{$user->firstname} {$user->lastname} ({$user->username}) your id: {$user->id}");
    }
}
