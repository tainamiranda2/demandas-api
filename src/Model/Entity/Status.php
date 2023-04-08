<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Status Entity
 *
 * @property int $id
 * @property string $nome_status
 * @property int $usuario_id
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Demanda[] $demandas
 */
class Status extends Entity
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
        'nome_status' => true,
        'usuario_id' => true,
        'usuario' => true,
        'demandas' => true,
    ];
}
