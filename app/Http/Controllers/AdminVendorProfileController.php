<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminVendorProfileController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::user()->id)->first();
        return view('admin.vendor-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner'        => ['required', 'max:2000'],
            'phone'         => ['required', 'max:50'],
            'email'         => ['required', 'max:50'],
            'address'       => ['required'],
            'description'   => ['required'],
            'fb_link'       => ['nullable', 'url'],
            'tw_link'       => ['nullable', 'url'],
            'inst_link'     => ['nullable', 'url'],
        ]);

        $vendor = Vendor::where('user_id', Auth::user()->id)->first();
        $bannerPath = $this->updateImage($request, 'banner', 'upload', $vendor->banner);
        $vendor->banner = empty(!$bannerPath) ? $bannerPath : $vendor->banner;
        $vendor->phone  = $request->phone;
        $vendor->email  = $request->email;
        $vendor->address  = $request->address;
        $vendor->description  = $request->description;
        $vendor->fb_link  = $request->fb_link;
        $vendor->tw_link  = $request->tw_link;
        $vendor->inst_link  = $request->inst_link;
        $vendor->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
