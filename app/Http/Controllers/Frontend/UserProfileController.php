<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\fileExists;

class UserProfileController extends Controller
{
    public function index() {
        return view('frontend.dashboard.profile');
    }

    public function updateProfile (Request $request)
    {
        $request->validate([
            'name'  => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' .Auth::user()->id],
            'image' => ['image', 'max:2048']
        ]);

        $users = Auth::user();

        if($request->hasFile('image')){
            if(file::exists()(public_path($users->image))){
                file::delete(public_path($users->image));
            }

            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('upload'), $imageName);

            $path = 'upload/'.$imageName;
            $users->image = $path;
        }

        $users->name = $request->name;
        $users->email = $request->email;
        $users->save();

        return redirect()->back();
    }
}
