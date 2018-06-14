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
    public function index($orderBy, $sort, $limit) {

        $sql = 'SELECT users.id AS user_id, products.*, images.path
                FROM images
                INNER JOIN (products inner join users 
                ON users.id = products.user_id)
                ON products.id = images.product_id
                ORDER BY ' . $orderBy . ' ' . $sort . 
                ' LIMIT ' . $limit . ', 10';

        $sqlcount = 'SELECT COUNT(*) AS value FROM products';

        $products = $this->dbo->setQuery($sql)->getList(get_class($this));
        // $count = $this->dbo->setQuery($sqlcount)->getList(get_class($this));
        $count = $this->dbo->setQuery($sqlcount)->getResult($this);
        return ["products" => $products, "count" => $count];
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

        $sql =  'SELECT users.login AS user_login,
                users.email AS user_email, users.phone AS user_phone, 
                products.*, images.path
                FROM images
                INNER JOIN (products inner join users 
                ON users.id = products.user_id)
                ON products.id = images.product_id
                WHERE products.id = ' . (int)$id;

        return $this->dbo->setQuery($sql)->getResult($this);
    }
}