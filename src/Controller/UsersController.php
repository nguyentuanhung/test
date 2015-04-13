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

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * UserController.
 *
 * @author Hung
 *        
 */
class UsersController extends AppController {
    
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
    public function login() {
        if ($this->Auth->user()) {
            $this->redirect(
                    [ 'controller' => 'Products','action' => 'index' ]);
        }
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('ログインできません'));
        }
    }
    
    /**
     */
    public function register() {
        if ($this->Auth->user()) {
            $this->redirect(
                    [ 'controller' => 'Products','action' => 'index' ]);
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('登録が完了しました'));
                $this->Auth->setUser($user->toArray());
                return $this->redirect(
                        [ 'controller' => 'Products','action' => 'index' ]);
            }
            $this->Flash->error(__('登録できません'));
        }
        $this->set('user', $user);
    }
    
    /**
     */
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}