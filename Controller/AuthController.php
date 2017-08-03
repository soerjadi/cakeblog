<?php

App::uses('AppController', 'Controller');

class AuthController extends AppController {
    
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logouth');
    }

    public function index() 
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}