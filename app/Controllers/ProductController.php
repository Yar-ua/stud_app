<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ImageModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Auth\AuthService;

/**
 * Product controller
 *
 * Class ProductController
 * @package App\Controllers
 */
class ProductController
{
    /**
     * Products index page
     */
    function index(ProductModel $model){

        return $model->getList();
    }

    /**
     * Single product page
     *
     * @param   ProductModel
     * @param   int Product ID
     *
     * @return  mixed
     * @throws NotFoundException
     */
    function show(ProductModel $model, $id){

        $item = $model->load($id);

        // Check if record exists
        if(empty($item)) {
            throw new NotFoundException('Product with id ' . $id . ' not found');
        }

        return $item;
    }

    /**
     * Create product
     */
    function create(Request $request, ProductModel $model, ImageModel $imageModel){

        //@TODO: Implement this
        // Accept the assumption that from the form in POST request 
        // comes the embedded JSON hash with the key "formData"
        // stuff like {"formData": {"...":"...", "...":"..." ...}, "image": {"filename":"...", "body":"..."}
        
        // request example:
        //         {
        // "formData": 
        //     {
        //         "name":"google",
        //         "description":"expensive firm",
        //         "price":"1000"
        //     },
        // "image":
        //     {
        //         "filename":"1aa.jpeg",
        //         "body":"data:image/png;base64,iVBORw0KG ... base64 code of image body must be here "
        //     }
        // }


        // Take information, what sendeed in form
        $user = AuthService::getUser();
        $data = $request->get('formData', null, 'array');
        $data += ['user_id' => $user->id];
        $imageData = $request->get('image', null, '');

        if(empty($data)) {
            throw new \Exception('No POST data to create item');
        }

        // creating product in DB
        $item = $model->create($data);

        //if creating was successful
        if ($item->id) {
            // uploading image
            if(!empty($imageData["filename"]) and !empty($imageData["body"])) {
                $imageData += ['product_id' => $item->id];
                $imageModel->upload($imageData);
            }
        }

        return $item;
    }

    /**
     * Update the product
     */
    function update(Request $request, ProductModel $model, $id) {

        $data = $request->get('formData', null, 'array');

        if(empty($data)) {
            throw new \Exception('No PUT data to update item, nothing changes');
        }

        $item = $model->save($id, $data);

        return $item;
    }

    /**
     * Delete the product
     */
    function delete(ProductModel $model, $id, ImageModel $imageModel) {

        $user = AuthService::getUser();
        $item = $model->load($id);

        // validate authorisation
        if ( ($item->user_id == $user->id) or ($user->role == 'admin') ) {
            //if valid - remove image
            if ($imageModel->remove($id)) {
                //if image removed - delete product data from DB
                $item = $model->delete($id);
            } else {
                throw new \Exception('Deleting error - product not deleted');
            }
            return $item;
        } else {
            throw new \Exception('Forbidden - you are not product owner or admin');
        }
    }
}


/*
SELECT * FROM products 
inner join images
on products.id = images.product_id
WHERE products.id = 55

*/