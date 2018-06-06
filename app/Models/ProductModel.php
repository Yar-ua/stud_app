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
        $result = $this->dbo->setQuery($sql)->getResult($this);

        if ($result == false) {
            $sql = 'SELECT * FROM products WHERE products.id = ' . (int)$id;
            $result = $this->dbo->setQuery($sql)->getResult($this);
        }
        return $result;

        // return $this->dbo->setQuery($sql)->getResult($this);

        /*
        SELECT * FROM products 
        inner join images
        on products.id = images.product_id
        WHERE products.id = 55
SELECT products.*, images.path FROM `products` INNER JOIN `images` ON products.id = images.product_id WHERE products.id = 61 


IF EXISTS (select * from images where product_id = 61) THEN
    SELECT products.*, images.path from products
    inner join images on products.id = images.product_id
    where products.id = 61
ELSE * from products where id = 61
END IF

select products.*,
case
    when not exists (images.path)
    then 'null'
    else images.path
    end
from products inner join images
on products.id = images.product_id
where products.id = 61

SELECT * FROM products
                INNER JOIN `images` ON products.id = images.product_id 




select products.name, products.price, images.path,
case when images.path is not null then images.path
else 'non' end
from products inner join images
on products.id = images.product_id
where products.id = 70
        */

    }
}