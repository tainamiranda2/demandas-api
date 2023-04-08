<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuario Model
 *
 * @property \App\Model\Table\UsuariosTable&\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\PapelTable&\Cake\ORM\Association\BelongsTo $Papel
 * @property \App\Model\Table\DemandasTable&\Cake\ORM\Association\HasMany $Demandas
 * @property \App\Model\Table\PapelTable&\Cake\ORM\Association\HasMany $Papel
 * @property \App\Model\Table\SetorTable&\Cake\ORM\Association\HasMany $Setor
 * @property \App\Model\Table\StatusTable&\Cake\ORM\Association\HasMany $Status
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\HasMany $Usuario
 *
 * @method \App\Model\Entity\Usuario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuario|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuario findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuarioTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('usuario');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Papel', [
            'foreignKey' => 'papel_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Demandas', [
            'foreignKey' => 'usuario_id',
        ]);
        $this->hasMany('Papel', [
            'foreignKey' => 'usuario_id',
        ]);
        $this->hasMany('Setor', [
            'foreignKey' => 'usuario_id',
        ]);
        $this->hasMany('Status', [
            'foreignKey' => 'usuario_id',
        ]);
        $this->hasMany('Usuario', [
            'foreignKey' => 'usuario_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('nome')
            ->maxLength('nome', 100)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmptyString('email');

        $validator
            ->integer('telefone')
            ->requirePresence('telefone', 'create')
            ->notEmptyString('telefone');

        $validator
            ->integer('senha')
            ->requirePresence('senha', 'create')
            ->notEmptyString('senha');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['usuario_id'], 'Usuario'));
        $rules->add($rules->existsIn(['papel_id'], 'Papel'));

        return $rules;
    }
}
