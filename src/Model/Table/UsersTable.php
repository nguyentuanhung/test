<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * User Table.
 *
 * @author Hung
 *        
 */
class UsersTable extends Table {
    /**
     * (non-PHPdoc)
     *
     * @see \Cake\ORM\Table::initialize()
     */
    public function initialize(array $config) {
        $this->table('users_master');
        $this->addBehavior('Timestamp');
        $this->primaryKey('id');
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Cake\ORM\Table::validationDefault()
     */
    public function validationDefault(Validator $validator) {
        return $validator->notEmpty('username', 'ユーザ名を入力してください')->notEmpty(
                'email', 'メールを入力してください')->notEmpty('password', 'パスワードを入力してください')->notEmpty(
                'role', 'ロールを選択してください')->add('role', 'inList', 
                [ 'rule' => [ 'inList',[ 'admin','customer' ] ],
                        'message' => 'Please enter a valid role' ])->add('email', 
                [ 
                        'unique' => [ 'rule' => 'validateUnique',
                                'provider' => 'table',
                                'message' => '既に登録されたメールです' ] ])->add('email', 
                'validFormat', [ 'rule' => 'email',
                        'message' => 'メールフォーマット違反' ]);
    }
}