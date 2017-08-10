<?php

App::uses('AppController', 'Controller');

class DashboardController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel("UserModel");
        $this->layout = "admin";
        $currentUser = $this->currentUser;
        $this->set(compact('currentUser'));
    }

    public function isAuthorized()
    {
        $user = $this->Auth->user();
        $isAdmin = isset($user['role']) && $user['role'] == 0;
        switch ($this->action) {
            case 'userList' :
            case 'userAdd' :
            case 'editUser' :
            case 'deleteUser' :
                return $isAdmin;
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
        $users = $this->UserModel->find('all');
        $this->set(compact('users'));
    }

    public function editUser($id)
    {
        if (!$id) {
            throw new NotFoundException(__('Please provide the ID'));
        }

        $user = $this->UserModel->findById($id);
        if (!$user) {
            throw new NotFoundException(__('Invalid User'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->UserModel->id = $id;
            $data = $this->request->data;
            $data['updated_time'] = date('Y-m-d H:i:s');

            if (empty($data['password'])) {
                $this->UserModel->validator()->remove('password');
            }

            if ($this->UserModel->save($data)) {
                $this->Session->setFlash(__('User has been updated.'));
                $this->redirect(array('controller' => 'dashboard', 'action' => 'userList'));
            } else {
                if (count($this->UserModel->validationErrors) > 0) {
                    $errorMessage = array_values($this->UserModel->validationErrors)[0][0];
                    $this->Session->setFlash(__($errorMessage));
                } else {
                    $this->Session->setFlash(__('Cannot update user'));
                }
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }

        $this->set(compact('user'));
    }

    public function edit($id = null) {

        if (!$id) {
            throw new NotFoundException(__('Invalid user'));
        }

        $user = $this->User->findById($id);

        if (!$user) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('User has been updated.'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to update User.'));
            }
        }
        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function deleteUser($id)
    {
        $this->UserModel->delete($id);
        $this->Session->setFlash(__('Delete user successfully'));
        $this->redirect(array('controller' => 'dashboard', 'action' => 'userList'));
    }

    public function userAdd()
    {
        if ($this->request->is('post')) {
            $this->UserModel->create();

            if ($this->UserModel->save($this->request->data)) {
                $this->Session->setFlash(__('Add User successfully'));

                $this->redirect(array('controller' => 'dashboard', 'action' => 'userList'));
            } else {
                if (count($this->UserModel->validationErrors) > 0) {
                    $errorMessage = array_values($this->UserModel->validationErrors)[0][0];
                    $this->Session->setFlash(__($errorMessage));
                } else {
                    $this->Session->setFlash(__('Cannot add user'));
                }
            }
        }
    }
}