<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel("User");
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