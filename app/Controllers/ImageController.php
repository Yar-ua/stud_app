<?php

namespace App\Controllers;

use App\Models\ImageModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Auth\AuthService;


class ImageController
{
    private static $valid_types = array("gif","jpg", "png", "jpeg");

    function create(Request $request, ImageModel $model){
        // for creation cnd catch file with image you must send image with key 'imagefile'
        // and product id must be in request with key 'product_id'
        // this is deal of my framework
        $user = AuthService::getUser();

        if (isset($_FILES['imagefile'])) {

            $ext = substr($_FILES['imagefile']['name'], 1 + strrpos($_FILES['imagefile']['name'], "."));

            if($_FILES['imagefile']['size'] > 1024*3*1024) {
                throw new \Exception('Too big file size, must be less 3 MB');
            } 

            if (!in_array($ext, self::$valid_types)) {
                throw new \Exception('Incorrect type of image, must be jpg, jpeg, png or gif');
            }

            if(is_uploaded_file($_FILES['imagefile']['tmp_name'])) {
                $fileName = md5(microtime()) . substr($_FILES['imagefile']['name'], -4, 4);

                if ( copy($_FILES['imagefile']['tmp_name'],'uploads/'.$fileName) ) {
                    //@@ TODO productId

                    $data = ['product_id' => $request->get('product_id'), 'path' => $fileName];
                    $item = $model->create($data);

                    return $item;

                } else {
                    throw new \Exception('Image not uploaded');
                }

            } else {
                return false;
            }

        } else {
            return false;
        }
    }


    /**
     * Delete the image by product_id
     */
    function delete(ImageModel $model, $id) {
        $file = $model->load($id);
        if ($file) {
            if (unlink('uploads/' . $file->path)) {
                return $model->delete($id);
            } else {
                throw new \Exception('Image not deleted');
            }
        } else {
            throw new \Exception('There is no file with current id');
        }
    }
}