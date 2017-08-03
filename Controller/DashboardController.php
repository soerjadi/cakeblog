<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel("User");
    }

    public function isAuthorized()
    {
        $user = $this->Auth->user();
        switch ($this->action) {
            case 'userList' :
                return isset($user['role']) && $user['role'] == 0;
            case 'index':
                return isset($user);
            default:
                return false;
                break;
        }
    }

    public function index()
    {
        // TODO(*): create something cool here.
    }

    public function userList() 
    {
        $this->set('users', $this->User->find('all'));
    }
}