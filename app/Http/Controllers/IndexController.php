<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class IndexController extends Controller
{
    public function index(): Response
    {
        // check if the user is logged in, if not, render the login page
        if (!auth()->check()) {
            return Inertia::render('session/login');
        }
        return Inertia::render('app');
    }

    public function tutorial(): Response
    {
        return Inertia::render('tutorial_nonApp');
    }
}
