<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected array $keys = [
        'site_name', 'hero_title', 'hero_accent', 'hero_subtitle',
        'about_text', 'about_photo',
        'contact_email', 'contact_phone', 'contact_whatsapp',
        'linkedin_url', 'github_url', 'location',
    ];

    public function edit()
    {
        $settings = Setting::many($this->keys);

        return view('admin.settings.edit', ['settings' => $settings]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_accent' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:1000'],
            'about_text' => ['nullable', 'string'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'contact_whatsapp' => ['nullable', 'string', 'max:50'],
            'linkedin_url' => ['nullable', 'string', 'max:255'],
            'github_url' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        if ($request->hasFile('about_photo')) {
            $path = $request->file('about_photo')->store('uploads', 'public');
            Setting::set('about_photo', '/storage/' . $path);
        }

        return back()->with('status', 'Contenu mis à jour.');
    }
}
