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
}