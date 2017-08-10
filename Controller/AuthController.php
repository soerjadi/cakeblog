<?php

App::uses('AppController', 'Controller');

class AuthController extends AppController {
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('index', 'logouth');
    }

    public function index() 
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $user = $this->Auth->user();
                $this->updateLastLogin($user['id']);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }

        if ($this->isLoggedIn) {
            $this->redirect(array('controller' => 'dashboard', 'action' => 'index'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}