<?php

namespace Modules\Pomodoro\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PomodoroController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && is_null($request->user()->email_verified_at)) {
            return redirect()->route('verification.notice');
        }

        return view('pages.pomodoro');
    }
}
