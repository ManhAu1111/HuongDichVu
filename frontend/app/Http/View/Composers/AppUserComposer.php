<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class AppUserComposer
{
    public function compose(View $view)
    {
        $token = request()->cookie('auth_token');
        $userId = null;

        if ($token) {
            try {
                $parts = explode('.', $token);
                if (count($parts) >= 2) {
                    $payload = json_decode(base64_decode($parts[1]), true);
                    $userId = $payload['sub'] ?? null;
                }
            } catch (\Exception $e) {
                $userId = null;
            }
        }

        $view->with('globalUserId', $userId);
    }
}
