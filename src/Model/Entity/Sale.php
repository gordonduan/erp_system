<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Sale Entity
 *
 * @property int $id
 * @property int $product_id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property int $quantity
 * @property float $price
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $date
 *
 * @property \App\Model\Entity\Product $product
 * @property \App\Model\Entity\Category $category
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
        'product_id' => true,
        'category_id' => true,
        'name' => true,
        'description' => true,
        'quantity' => true,
        'price' => true,
        'amount' => true,
        'date' => true,
        'product' => true,
        'category' => true
    ];
}
