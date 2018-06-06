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
    public function upload($imageData, $product_id) {

        $data = ['product_id' => $product_id];

        if(!empty($imageData["filename"]) and !empty($imageData["body"])) {
            $ext = substr($imageData['filename'], 1 + strrpos($imageData['filename'], "."));

            // validate correct file extendion
            if (!in_array($ext, self::$valid_types)) {
                throw new \Exception('Incorrect type of image, must be jpg, jpeg, png or gif');
            }

            $filename = md5(microtime()) . '.' . $ext;
            $body = explode("base64,", $imageData['body']);

            // if file upload was successful
            if ( file_put_contents('uploads/' . $filename, base64_decode($body[1])) !== false ) {
                $data += ['path' => $filename];
            } else {
                throw new \Exception('Image not uploaded');
            }
        }

        // if image upload => $data = ['product_id' => $product_id, 'path' => $filename] 
        // in not upload => $data =  ['product_id' => $product_id]
        return parent::create($data); 

    }

   /**
     * Delete image from DB and delete file
     *
     * @param   $id
     *
     * @return  object
     */
    public function remove($id) {
        $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE `product_id`='.(int)$id;
        $image = $this->dbo->setQuery($sql)->getResult($this);

        if ($image->path) {
            unlink('uploads/' . $image->path);
        }

        return parent::delete($image->id);
    }

}