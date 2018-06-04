<?php

namespace App\Models;

use Mindk\Framework\DB\DBOConnectorInterface;
use Mindk\Framework\DI\Service;
use Mindk\Framework\Models\Model;

/**
 * Class ProductModel
 *
 * @package App\Models
 */
class ImageModel extends Model
{
    protected $tableName = 'images';

    /**
     * Delete record from DB
     */
    // public function delete($id) {
    //     //@TODO: Implement this
    //     // check for exsistense model in DB with specified id
    //     if ( empty(self::load($id)) ) {
    //         throw new \Exception('No data with current id in DB to delete');
    //     }

    //     $sql = 'DELETE FROM `' . $this->tableName . '` WHERE product_id=' . (int)$id;
    //     $this->dbo->setQuery($sql);
    //     return true;
    // }
}