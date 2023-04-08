<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Papel Model
 *
 * @property \App\Model\Table\UsuariosTable&\Cake\ORM\Association\BelongsTo $Usuarios
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\HasMany $Usuario
 *
 * @method \App\Model\Entity\Papel get($primaryKey, $options = [])
 * @method \App\Model\Entity\Papel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Papel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Papel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Papel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Papel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Papel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Papel findOrCreate($search, callable $callback = null, $options = [])
 */
class PapelTable extends Table
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

        $this->setTable('papel');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Usuario', [
            'foreignKey' => 'papel_id',
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
            ->scalar('papel_nome')
            ->maxLength('papel_nome', 45)
            ->requirePresence('papel_nome', 'create')
            ->notEmptyString('papel_nome');

        $validator
            ->scalar('adm')
            ->maxLength('adm', 3)
            ->requirePresence('adm', 'create')
            ->notEmptyString('adm');

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
        $rules->add($rules->existsIn(['usuario_id'], 'Usuario'));

        return $rules;
    }
}
