<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ProductsTable Table.
 *
 * @author Hung
 *        
 */
class ProductsTable extends Table {
    /**
     * (non-PHPdoc)
     *
     * @see \Cake\ORM\Table::initialize()
     */
    public function initialize(array $config) {
        $this->table('products_master');
        $this->addBehavior('Timestamp');
        $this->primaryKey('id');
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Cake\ORM\Table::validationDefault()
     */
    public function validationDefault(Validator $validator) {
        $validator->notEmpty('name', '商品名を入力してください')->add('img', 
                [ 
                        'extension' => [ 
                                'rule' => [ 'extension',
                                        [ 'jpeg','png','jpg' ] ],
                                'message' => '画像をアップロードしてください' ] ]);
        
        return $validator;
    }
}