<?php

namespace App\Controllers;

use App\Models\ImageModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;


class ImageController
{

    function index(ImageModel $model){
        // return $model->getList();
        die('index image');
    }


    function show(ImageModel $model, $id){

        // $item = $model->load($id);

        // if(empty($item)) {
        //     throw new NotFoundException('Product with id ' . $id . ' not found');
        // }

        // return $item;
    }


    function create(Request $request, ImageModel $model){
        var_dump($_FILES);
        echo('create image'); 

    }

    function update(Request $request, ImageModel $model, $id) {

    //     $data = $request->get('formData', null, 'array');

    //     if(empty($data)) {
    //         throw new \Exception('No PUT data to update item, nothing changes');
    //     }

    //     $item = $model->save($id, $data);

    //     return $item;
    // }


    function delete(ImageModel $model, $id) {
        
        // $item = $model->delete($id);
        // return $item;
    }
}