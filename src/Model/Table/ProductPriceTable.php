<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 *
 * @author Hung
 *        
 */
class ProductPriceTable extends Table {
    /**
     * (non-PHPdoc)
     *
     * @see \Cake\ORM\Table::validationDefault()
     */
    public function validationDefault(Validator $validator) {
        $validator->notEmpty('quantity_from', '商品最低数を入力してください')->notEmpty(
                'quantity_to', '商品最大数を入力してください')->notEmpty('price', 
                '価格を入力してください')->notEmpty('ship_fee', '送料を入力してください')->add(
                'quantity_from', 'validFormat', 
                [ 'rule' => 'numeric','message' => '数字を入力してください' ])->add(
                'quantity_to', 'validFormat', 
                [ 'rule' => 'numeric','message' => '数字を入力してください' ])->add(
                'price', 'validFormat', 
                [ 'rule' => 'numeric','message' => '数字を入力してください' ])->add(
                'ship_fee', 'validFormat', 
                [ 'rule' => 'numeric','message' => '数字を入力してください' ]);
        
        return $validator;
    }
    
    /**
     * (non-PHPdoc)
     *
     * @see \Cake\ORM\Table::initialize()
     */
    public function initialize(array $config) {
        $this->table('product_price');
        $this->addBehavior('Timestamp');
        $this->primaryKey('id');
        $this->belongsTo('Products', 
                [ 'className' => 'Products','foreignKey' => 'product_id' ]);
    }
    
    /**
     *
     * @return \Cake\Database\$this
     */
    public function findAllProducts() {
        return $this->find('all', [ 'contain' => [ 'Products' ] ])->select(
                [ 'Products.name','Products.description','Products.img',
                        'ProductPrice.id','ProductPrice.quantity_from',
                        'ProductPrice.quantity_to','ProductPrice.price',
                        'ProductPrice.ship_fee' ]);
    }
    
    /**
     *
     * @param unknown $searchData            
     */
    public function findProductsByNameAndQuantity($searchData) {
        return $this->find('all', [ 'contain' => [ 'Products' ] ])->select(
                [ 'Products.name','Products.description','Products.img',
                        'ProductPrice.id','ProductPrice.quantity_from',
                        'ProductPrice.quantity_to','ProductPrice.price',
                        'ProductPrice.ship_fee' ])->where(
                [ 'Products.name' => $searchData ['name'],
                        'ProductPrice.quantity_from <= ' => $searchData ['quantity'],
                        'ProductPrice.quantity_to >= ' => $searchData ['quantity'] ]);
    }
    
    /**
     *
     * @param unknown $productId            
     */
    public function findByProductId($productId) {
        return $this->find('all', [ 'contain' => [ 'Products' ] ])->select(
                [ 'Products.name','Products.description','Products.img',
                        'ProductPrice.id','ProductPrice.quantity_from',
                        'ProductPrice.quantity_to','ProductPrice.price',
                        'ProductPrice.ship_fee' ])->where(
                [ 'ProductPrice.product_id' => $productId ]);
    }
}