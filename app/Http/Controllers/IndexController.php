<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        $message = null;
        if (request()->session()->get('success') !== null) {
            $message = [
                'type' => 'success',
                'message' => request()->session()->get('success')
            ];
        } else if (request()->session()->get('error') !== null) {
            $message = [
                'type' => 'error',
                'message' => request()->session()->get('error')
            ];
        }

        return Inertia::render('app', [
            'message' => $message,
        ]);
    }

    public function tutorial(): Response
    {
        return Inertia::render('tutorial_nonApp');
    }
}
