<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * ProductsController.
 *
 * @author Hung
 *        
 */
class ProductsController extends AppController {
    /**
     * (non-PHPdoc)
     *
     * @see \App\Controller\AppController::beforeFilter()
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
    }
    
    /**
     */
    public function index() {
        $this->set('products', $this->Products->find('all'));
    }
    
    /**
     *
     * @param unknown $productId            
     */
    public function detail($productId) {
        $productPriceTable = $this->__getTable('ProductPrice');
        $products = $productPriceTable->findByProductId($productId);
        $this->set(compact('products', 'productId'));
    }
    
    /**
     */
    public function add($productId = 0) {
        if ($productId == 0) {
            $product = $this->Products->newEntity();
            if ($this->request->is('post')) {
                $postData = $this->request->data;
                $file = $postData ['img'];
                move_uploaded_file($file ['tmp_name'], 
                        WWW_ROOT . 'img/products/' . $file ['name']);
                $postData ['img'] = $file ['name'];
                $product = $this->Products->patchEntity($product, $postData);
                if ($this->Products->save($product)) {
                    $this->Flash->success(__('新商品を保存しました'));
                    return $this->redirect([ 'action' => 'index' ]);
                }
                $this->Flash->error(__('新商品が保存できません'));
            }
        } else {
            $productPriceTable = $this->__getTable('ProductPrice');
            $product = $productPriceTable->newEntity();
            if ($this->request->is('post')) {
                $product = $productPriceTable->patchEntity($product, 
                        $this->request->data);
                if ($productPriceTable->save($product)) {
                    $this->Flash->success(__('新商品価格を保存しました'));
                    return $this->redirect(
                            [ 'action' => 'detail',$productId ]);
                }
                $this->Flash->error(__('新商品価格が保存できません'));
            }
            $this->set('productId', $productId);
        }
        $this->set('product', $product);
    }
    
    /**
     *
     * @param unknown $productId            
     */
    public function edit($productId, $productPriceId = 0) {
        if ($productPriceId == 0) {
            $product = $this->Products->get($productId);
            if ($this->request->is([ 'post','put' ])) {
                $this->Products->patchEntity($product, $this->request->data);
                if ($this->Products->save($product)) {
                    $this->Flash->success(__('商品を更新しました'));
                    return $this->redirect([ 'action' => 'index' ]);
                }
                $this->Flash->error(__('商品が更新できません'));
            }
        
        } else {
            $productPriceTable = $this->__getTable('ProductPrice');
            $product = $productPriceTable->get($productPriceId);
            if ($this->request->is([ 'post','put' ])) {
                $productPriceTable->patchEntity($product, $this->request->data);
                if ($productPriceTable->save($product)) {
                    $this->Flash->success(__('商品価格を更新しました'));
                    return $this->redirect([ 'action' => 'detail',
                            $productId ]);
                }
                $this->Flash->error(__('商品価格を更新しました'));
            }
            $this->set('productPriceId', $productPriceId);
        }
        
        $this->set('product', $product);
    }
    
    /**
     *
     * @param unknown $productId            
     */
    public function delete($productId, $productPriceId = 0) {
        $this->request->allowMethod([ 'post','delete' ]);
        if ($productPriceId == 0) {
            if ($this->Products->delete($this->Products->get($productId))) {
                $productPriceTable = $this->__getTable('ProductPrice');
                foreach ( $productPriceTable->findByProductId($productId) as $product ) {
                    $productPriceTable->delete($product);
                    $this->Flash->success(__('商品を削除しました'));
                }
            }
            return $this->redirect([ 'action' => 'index' ]);
        } else {
            $productPriceTable = $this->__getTable('ProductPrice');
            $product = $productPriceTable->get($productPriceId);
            if ($productPriceTable->delete($product)) {
                $this->Flash->success(__('商品価格を削除しました'));
                return $this->redirect([ 'action' => 'detail',$productId ]);
            }
        }
    
    }
    
    /**
     */
    public function search() {
        if ($this->request->is('post')) {
            $productPriceTable = $this->__getTable('ProductPrice');
            $searchResults = $productPriceTable->findProductsByNameAndQuantity(
                    $this->request->data);
            $this->set('searchResults', $searchResults);
        }
    }
    
    /**
     *
     * @param unknown $tableName            
     * @return \Cake\ORM\Table
     */
    private function __getTable($tableName) {
        return TableRegistry::get($tableName);
    }
}