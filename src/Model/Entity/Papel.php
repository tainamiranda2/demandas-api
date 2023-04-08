<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Papel Entity
 *
 * @property int $id
 * @property string $papel_nome
 * @property int $adm
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Usuario[] $usuario
 */
class Papel extends Entity
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
        'papel_nome' => true,
        'adm' => true,
        'usuario_id' => true,
        'usuario' => true,
    ];
}
