<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;


class ImageServiceProvider extends Model
{

    /**
     * Store product image into local disk (local storage) and return
     * the object respond path and message on success.
     * @param Request $request
     * @param Form_Request_Value $imageFileName
     * @param String $codeName
     * @return RespondObject [ data: data_result, message: message_result ]
     */
    public static function storeImage($request, $imageFileName, $codeName){
        $respond = (object)[];

        // valid request image file
        if( $request->hasFile($imageFileName) ){
            // trim any symbol
            $codeName = preg_replace('/[^A-Za-z0-9\-]/', '', $codeName);

            $image = $request->file($imageFileName);

            // generate image name (codeName + D + current time)
            $currentTimeStamp = Carbon::now()->timestamp;
            $imageFileName = $codeName . 'D' . $currentTimeStamp . '.' . $image->getClientOriginalExtension();
            
            // make image
            $img = Image::make($image->getRealPath());

            // resize to current aspectRatio(250x300)
            $img->resize(
                250, // width
                300, // height
                function ($constraint) {
                    $constraint->aspectRatio();
                }
            );

            // encoded image
            $img->stream();
            $imagePath = 'images/products/'.$imageFileName;

            // store into disk
            Storage::disk('public')->put($imagePath, $img);

            $respond->data = $imagePath;
            $respond->message = 'Product image successfully store into local disk.';
            
        } else {
            $respond->data = false;
            $respond->message = 'No product image file found, unable to store into disk!';
        }

        return $respond;
    }

    /**
     * Delete image file from local storage by provided parameter.
     * @param String $imagePath
     * @return RespondObject [ data: data_result, message: message_result]
     */
    public static function deleteImageStorage($imagePath){
        $respond = (object)[];

        // delete file from storage
        $result = Storage::disk('public')->delete($imagePath);
        if(!$result){ // false
            $respond->data = $result;
            $respond->message = $imagePath.' image file not found, enable to process the delete!';
        } else { // true
            $respond->data = $result;
            $respond->message = 'Image file successfully deleted from local storage';
        }

        return $respond;
    }
    
}
