<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Image;

/**
 *
 */
trait StoreImageTrait
{
    public function storeImage($image, $height = 200, $width = 200)
    {
        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('storage/thumbnail');
        $img = Image::make($image->getRealPath());
        // $img->resize($width, $height, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save($destinationPath . '/' . $input['imagename']);
        $img->resize($width, $height)->save($destinationPath . '/' . $input['imagename']);

        $destinationPath = public_path('storage/images');
        $image->move($destinationPath, $input['imagename']);

        Storage::delete('public/images/'.$input['imagename']);
        return env('APP_URL').'/storage/thumbnail/'.$input['imagename'];
    }
}
