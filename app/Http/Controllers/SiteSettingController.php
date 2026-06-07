<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $settings = SiteSetting::getSettings();
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::getSettings();

        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'hero_tagline' => 'required|string|max:255',
            'hero_title' => 'required|string|max:1000',
            'hero_description' => 'required|string',
            'contact_whatsapp' => 'required|string|max:20',
            'price_startup' => 'required|string|max:100',
            'price_professional' => 'required|string|max:100',
            'price_enterprise' => 'required|string|max:100',
            'instagram_url' => 'required|string|max:255',
            'dribbble_url' => 'required|string|max:255',
            'behance_url' => 'required|string|max:255',
            'linkedin_url' => 'required|string|max:255',
        ]);

        $settings->update($validated);

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
