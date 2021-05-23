<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for the session route.
 */
class SessionController extends Controller
{
    public function show()
    {
        return view('session');
    }

    public function destroy()
    {
        session()->flush();
        return view('session');
    }
}
