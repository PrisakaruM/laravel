<?php

namespace App\Helpers\Image;
 
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;

class Processing {

    public static function upload($files, $path, $filename = '')
    {
        if (!File::isDirectory(public_path('/').$path)) {
            File::makeDirectory(public_path('/').$path, 0777, true, true);    
        } else {
            if (!empty($filename)) {
                File::delete(public_path('/').$path . '/' . $filename);
            }            
        }

        if ($files) {
           $profileImage = time() . "." . $files->getClientOriginalExtension();
           $files->move($path, $profileImage);
        }

        return $profileImage; 
    }

    public static function uploadBase64 ($base64, $old_image)
    {
        $image_parts = explode(";base64,", $base64);
        $extension = explode("image/", $image_parts[0]);
        $imageName = time() .'.' . $extension[1];

        if (!\File::put(public_path() . '/img/admin/' . $imageName, base64_decode($image_parts[1]))) {
            return false;
        }

        if (!empty($old_image)) {
            File::delete(public_path() . '/img/admin/' . $old_image);
        }

        return $imageName;
    }
}