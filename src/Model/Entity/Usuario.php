<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Usuario Entity
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property int $telefone
 * @property int $senha
 * @property int $usuario_id
 * @property int $papel_id
 *
 * @property \App\Model\Entity\Usuario[] $usuario
 * @property \App\Model\Entity\Papel[] $papel
 * @property \App\Model\Entity\Demanda[] $demandas
 * @property \App\Model\Entity\Setor[] $setor
 * @property \App\Model\Entity\Status[] $status
 */
class Usuario extends Entity
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
        'nome' => true,
        'email' => true,
        'telefone' => true,
        'senha' => true,
        'usuario_id' => true,
        'papel_id' => true,
        'usuario' => true,
        'papel' => true,
        'demandas' => true,
        'setor' => true,
        'status' => true,
    ];
}
