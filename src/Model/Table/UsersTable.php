<?php

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
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

        $this->setTable('users');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
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
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->alphaNumeric('username', 'El nombre de usuario debe ser alfanumérico')
            ->minLength('username', 3, 'El nombre de usuario debe tener al menos 3 caracteres')
            ->maxLength('username', 50, 'El nombre de usuario debe tener 50 caracteres como máximo')
            ->notBlank('username', 'El nombre de usuario es requerido');

        $validator
            ->scalar('password')
            ->minLength('password', 6, 'La contraseña debe tener al menos 6 caracteres')
            ->maxLength('password', 64, 'La contraseña debe tener 64 caracteres como máximo')
            ->notBlank('password', 'La contraseña es requerida');

        $validator
            ->email('email', false, 'El correo electrónico es inválido')
            ->maxLength('email', 255)
            ->notBlank('password', 'El correo electrónico es requerido');

        $validator
            ->scalar('role')
            ->maxLength('role', 20)
            ->notBlank('role', 'El rol es requerido')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'guest']],
                'message' => 'Por favor ingresa un rol válido'
            ]);

        $validator
            ->boolean('inactive');

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
        $rules->add($rules->isUnique(['username']));
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
}
