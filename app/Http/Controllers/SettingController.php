<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;


class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'fav_icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'site_title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'contract_number' => 'required|string|max:20',
            'helpline_number' => 'required|string|max:20',
            'principle_email' => 'required|email|max:255',
            'institute_email' => 'required|email|max:255',
            'messenger_link' => 'required|max:255',
            'fb_link' => 'required|max:255',
            'instagram_link' => 'required|max:255',
            'youtube_link' => 'required|max:255',
            'linkedin' => 'required|max:255',
            'address' => 'required|string|max:500',
            'copyright_text' => 'nullable|string|max:255',

            // Meta columns validation
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string|max:255',
            'meta_url' => 'nullable|string|max:255',
            'meta_img' => 'nullable|file|mimes:webp,jpeg,png,jpg,gif,svg|max:2048',
        ]);


        try {
            DB::beginTransaction();

            $update = $request->all();

            $setting = Setting::findOrFail($id);

            // Save the current file paths for possible deletion later
            $currentLogo = $setting->logo;
            $currentFavicon = $setting->fav_icon;
            $currentPaymentImg = $setting->payment_img;
            $currentFooterBg = $setting->footer_bg;
            $currentMetaImg = $setting->meta_img;

            // Update the text fields and columns
            $setting->update($update);

            // Handle file uploads
            if ($request->hasFile('logo')) {
                $logoName = time() . '_logo.' . $request->logo->extension();
                $request->logo->move(public_path('image/setting'), $logoName);
                $setting->update(['logo' => $logoName]);
                if ($currentLogo) {
                    File::delete(public_path('image/setting') . '/' . $currentLogo);
                }
            }

            if ($request->hasFile('fav_icon')) {
                $faviconName = time() . '_favicon.' . $request->fav_icon->extension();
                $request->fav_icon->move(public_path('image/setting'), $faviconName);
                $setting->update(['fav_icon' => $faviconName]);
                if ($currentFavicon) {
                    File::delete(public_path('image/setting') . '/' . $currentFavicon);
                }
            }

            if ($request->hasFile('meta_img')) {
                $metaImgName = time() . '_meta.' . $request->meta_img->extension();
                $request->meta_img->move(public_path('image/setting'), $metaImgName);
                $setting->update(['meta_img' => $metaImgName]);
                if ($currentMetaImg) {
                    File::delete(public_path('image/setting') . '/' . $currentMetaImg);
                }
            }

            DB::commit();
            return redirect()->back()->with('success', 'Setting updated successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Something went wrong: ' . $e->getMessage());
        }
    }


}
