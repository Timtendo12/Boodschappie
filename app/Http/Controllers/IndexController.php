<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        $message = null;
        $messageTypes = ['success', 'error', 'warning', 'info'];

        foreach ($messageTypes as $type) {
            $sessionMessage = request()->session()->get($type);

            if ($sessionMessage !== null) {
                $message = [
                    'type' => $type,
                    'message' => $sessionMessage,
                ];
                break; // Exit the loop once a message is found
            }
        }

        $confetti = request()->session()->get('confetti');
        if ($confetti === null) {
            $confetti = false;
        }

        return Inertia::render('app', [
            'message' => $message,
            'confetti' => $confetti,
        ]);
    }

    public function tutorial(): Response
    {
        return Inertia::render('tutorial_nonApp');
    }
}
