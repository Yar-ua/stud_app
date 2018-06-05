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

    private static $valid_types = array("gif","jpg", "png", "jpeg");

    /**
     * Create image in DB and upload file
     *
     * @param   array $data['filename' => '...', 'body' => '...', 'product_id' => '...']
     *
     * @return  object
     */
    public function upload($data) {
        
        $ext = substr($data['filename'], 1 + strrpos($data['filename'], "."));

        // validate correct file extendion
        if (!in_array($ext, self::$valid_types)) {
            throw new \Exception('Incorrect type of image, must be jpg, jpeg, png or gif');
        }

        $filename = md5(microtime()) . '.' . $ext;
        $body = explode("base64,", $data['body']);

        // if file upload was successful
        if ( file_put_contents('uploads/' . $filename, base64_decode($body[1])) !== false ) {
            $item = parent::create(['product_id' => $data['product_id'], 'path' => $filename]);
            return $item;
        } else {
            throw new \Exception('Image not uploaded');
        }
    }

   /**
     * Delete image from DB and delete file
     *
     * @param   $id
     *
     * @return  object
     */
    public function remove($id) {
        $sql = 'SELECT * FROM `' . $this->tableName .
            '` WHERE `product_id`='.(int)$id;
        $image = $this->dbo->setQuery($sql)->getResult($this);
        if ($image) {
            if (unlink('uploads/' . $image->path)) {
                return parent::delete($image->id);
            } else {
                throw new \Exception('Image not deleted');
            }
        } else {
            throw new \Exception('There is no file with current id');
        }
    }

}