<?php

namespace Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Settings\Actions\SettingsUpdateAction;
use Modules\Settings\DTOs\UpdateSettingDTO;
use Modules\Settings\Requests\SettingsRequest;


class SettingController extends Controller
{
    public function show()
    {
        $settings = Auth::user()->settings->toFrontend();
        return view('pages.setting', compact('settings'));
    }

    public function update(SettingsRequest $request, SettingsUpdateAction $action)
    {
        try {
            $validated = $request->validated();
            $dto = new UpdateSettingDTO(...$validated);
            $action->execute(Auth::user(), $dto);
            return back()->with('success', 'Settings updated successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
