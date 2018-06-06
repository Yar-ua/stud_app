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
class ProductModel extends Model
{
    protected $tableName = 'products';

    /**
     * Get all products list
     *
     * @return  product inner join image
     */
    public function index() {

        $sql = 'SELECT users.id AS user_id, products.*, images.path
                FROM images
                INNER JOIN (products inner join users 
                ON users.id = products.user_id)
                ON products.id = images.product_id';

        return $this->dbo->setQuery($sql)->getList(get_class($this));
    }

    /**
     * Single product page
     *
     * @param   product id
     *
     * @return  product inner join image
     * @throws NotFoundException
     */
    public function show($id) {

        $sql = 'SELECT products.*, images.path FROM products 
                INNER JOIN `images` ON products.id = images.product_id 
                WHERE products.id = ' . (int)$id;

        return $this->dbo->setQuery($sql)->getResult($this);
    }
}