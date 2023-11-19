<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class SessionController extends Controller
{
    public function store()
    {
        return Inertia::render('app');
    }

    public function create()
    {
        return Inertia::render('app');
    }

    public function destroy()
    {
        return Inertia::render('app');
    }
}
