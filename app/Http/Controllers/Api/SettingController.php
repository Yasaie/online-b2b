<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends ApiController
{
    public function index(Request $request, $key = null)
    {
        $settings = Setting::get();

        $settings->map(function ($setting) {
            \Config::set('site.' . $setting->key, $setting->content ?: $setting->locale);
        });

        $key = $key ? '.' . str_replace('/', '.', $key) : '';

        $data = \Config::get('site' . $key);

        return compact('data');
    }

    public function update(Request $request, $key = null)
    {
        $settings = Setting::get();

        $key = str_replace('/', '.', $key);
        $key = $key ? $key . '.' : '';
        $success = 0;

        foreach ($request->all() as $name => $value) {
            /** @var Setting $setting */
            $setting = $settings->firstWhere('key', $key . $name);

            if ($setting) {
                if (is_array($value)) {
                    $setting->updateLocale('locale', $value);
                } else {
                    $setting->content = $value;
                }
                if ($setting->save()) {
                    $success++;
                }
            }
        }

        return compact('success');
    }
}
