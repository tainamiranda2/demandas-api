<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Demanda Entity
 *
 * @property int $id
 * @property string $nome_demanda
 * @property string $descricao
 * @property int $qtd
 * @property string $tipo
 * @property int $usuario_id
 * @property int $status_id
 * @property int $setor_id
 * @property string|null $motivo_demanda
 * @property \Cake\I18n\FrozenTime $data
 *
 * @property \App\Model\Entity\Usuario $usuario
 * @property \App\Model\Entity\Status $status
 * @property \App\Model\Entity\Setor $setor
 */
class Demanda extends Entity
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
        'nome_demanda' => true,
        'descricao' => true,
        'qtd' => true,
        'tipo' => true,
        'usuario_id' => true,
        'status_id' => true,
        'setor_id' => true,
        'motivo_demanda' => true,
        'data' => true,
        'usuario' => true,
        'status' => true,
        'setor' => true,
    ];
}
