<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notice Entity
 *
 * @property int $id
 * @property int $category
 * @property string $name
 * @property string $title
 * @property string $text
 * @property string $picture
 * @property string $video
 * @property string $content
 * @property string $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Notice extends Entity
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
        'category' => true,
        'name' => true,
        'title' => true,
        'document' => true,
        'image' => true,
        'video' => true,
        'content' => true,
        'status' => true,
        'created' => true,
        'modified' => true
    ];
}
