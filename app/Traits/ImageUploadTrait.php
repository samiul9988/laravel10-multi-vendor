<?php

namespace App\Traits;
use File;
use Illuminate\Http\Request;

trait ImageUploadTrait {
    public function uploadImage(Request $request, $inputName, $path){
        if ($request->hasFile($inputName)){
            $image      = $request->{$inputName};
            $ext        = $image->getClientOriginalExtension();
            $imageName  ='media_'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;

        }
    }

    public function uploadProductImage(Request $request, $inputName, $path){
        $pathimage = [];
        if ($request->hasFile($inputName)){
            $images      = $request->{$inputName};

            foreach ($images as $image){
                $ext        = $image->getClientOriginalExtension();
                $imageName  ='media_'.uniqid().'.'.$ext;

                $image->move(public_path($path), $imageName);

                $pathimage[] = $path.'/'.$imageName;
            }

            return $pathimage;

        }
    }

    public function updateImage(Request $request, $inputName, $path, $oldPath=NULL)
    {
        if ($request->hasFile($inputName)){
            if (File::exists(public_path($oldPath))){
                File::delete(public_path(($oldPath)));
            }

            $image      = $request->{$inputName};
            $ext        = $image->getClientOriginalExtension();
            $imageName  = 'media_'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);

            return $path .'/'. $imageName;
        }
    }

    public function deleteImage(string $path)
    {
        if (File::exists(public_path($path)))
        {
            File::delete(public_path($path));
        }
    }
}
