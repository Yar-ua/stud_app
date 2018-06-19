<?php

namespace App\Controllers;

// use App\Models\ProductModel;
// use App\Models\ImageModel;
use App\Models\UserAppModel;
use Mindk\Framework\Http\Request\Request;
use Mindk\Framework\Exceptions\NotFoundException;
use Mindk\Framework\Auth\AuthService;

/**
 * User controller
 *
 * Class UserAppController
 * @package App\Controllers
 */
class UserAppController
{
    /**
     * Users index page
     */
    function index(Request $request, UserAppModel $model){
        return $model->getList();
    }

    /**
     * Single user page
     *
     * @param   UserAppModel
     * @param   int User ID
     *
     * @return  mixed
     */
    function show(UserAppModel $model, $id){

        return $model->load($id);
    }


    /**
     * Update the user
     *
     * @param   UserAppModel
     * @param   int User ID
     *
     * @return  user model
     */
    function update(Request $request, UserAppModel $model, $id) {

        $data = $request->get('formData', null, 'array');

        if(empty($data)) {
            throw new \Exception('No PUT data to update item, nothing changes');
        }

        return $model->save($id, $data);
    }

    /**
     * Delete the product
     */
    function delete(ProductModel $model, $id, ImageModel $imageModel) {

        // $user = AuthService::getUser();
        // $item = $model->load($id);

        // // validate authorisation
        // if ( ($item->user_id == $user->id) or ($user->role == 'admin') ) {
        //     //  if valid - remove image
        //     if ($item = $model->delete($id)) {
        //         //  if product deleted from DB - remove image from server and DB
        //         $imageModel->remove($id);
        //     } else {
        //         throw new \Exception('Deleting error - product not deleted');
        //     }
        //     return $item;
        // } else {
        //     throw new \Exception('Forbidden - you are not product owner or admin');
        // }
    }
}