<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Demandas Model
 *
 * @property \App\Model\Table\UsuarioTable&\Cake\ORM\Association\BelongsTo $Usuario
 * @property \App\Model\Table\StatusTable&\Cake\ORM\Association\BelongsTo $Status
 * @property \App\Model\Table\SetorTable&\Cake\ORM\Association\BelongsTo $Setor
 *
 * @method \App\Model\Entity\Demanda get($primaryKey, $options = [])
 * @method \App\Model\Entity\Demanda newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Demanda[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Demanda|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demanda saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Demanda patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Demanda[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Demanda findOrCreate($search, callable $callback = null, $options = [])
 */
class DemandasTable extends Table
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

        $this->setTable('demandas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Usuario', [
            'foreignKey' => 'usuario_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Status', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Setor', [
            'foreignKey' => 'setor_id',
            'joinType' => 'INNER',
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
            ->scalar('nome_demanda')
            ->maxLength('nome_demanda', 60)
            ->requirePresence('nome_demanda', 'create')
            ->notEmptyString('nome_demanda');

        $validator
            ->scalar('descricao')
            ->maxLength('descricao', 100)
            ->requirePresence('descricao', 'create')
            ->notEmptyString('descricao');

        $validator
            ->integer('qtd')
            ->requirePresence('qtd', 'create')
            ->notEmptyString('qtd');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 40)
            ->requirePresence('tipo', 'create')
            ->notEmptyString('tipo');

        $validator
            ->scalar('motivo_demanda')
            ->maxLength('motivo_demanda', 60)
            ->allowEmptyString('motivo_demanda');

        $validator
            ->dateTime('data')
            ->notEmptyDateTime('data');

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
        $rules->add($rules->existsIn(['status_id'], 'Status'));
        $rules->add($rules->existsIn(['setor_id'], 'Setor'));

        return $rules;
    }
}
