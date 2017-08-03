<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel("User");
        $this->layout = "admin";
        $currentUser = $this->currentUser;
        $this->set(compact('currentUser'));
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
        $users = $this->User->find('all');
        $this->set(compact('users'));
    }

    public function editUser($id)
    {
        // TODO(*): create something cool here.
    }

    public function deleteUser($id)
    {
        $this->User->delete($id);
        $this->redirect(array('controller' => 'dashboard', 'action' => 'userList'));
    }
}