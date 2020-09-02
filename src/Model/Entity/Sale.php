<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sale Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property string $customer_name
 * @property int $product_id
 * @property string $product_name
 * @property int $product_price
 * @property int $quantity
 * @property \Cake\I18n\FrozenTime $order_date_at
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Product $product
 */
class Sale extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'customer_id' => true,
        'customer_name' => true,
        'product_id' => true,
        'product_name' => true,
        'product_price' => true,
        'order_date_at' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'product' => true,
    ];
}