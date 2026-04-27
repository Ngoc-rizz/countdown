<?php

namespace Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show(Request $request)
    {
        return view('pages.setting');
    }
}
