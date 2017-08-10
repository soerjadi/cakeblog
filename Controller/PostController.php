<?php

App::uses('AppController', 'Controller');

class PostController extends AppController {

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->loadModel('UserModel');
        $this->loadModel('ArticleModel');
        $this->layout = "admin";
        $currentUser = $this->currentUser;
        $isLoggedIn = isset($currentUser);
        $this->set(compact('currentUser', 'isLoggedIn'));
    }

    public function isAuthorized()
    {
        $user = $this->Auth->user();
        switch ($this->action) {
            case 'index':
            case 'addPost':
            case 'publishPost':
            case 'editPost':
            case 'deletePost':
                return isset($user);
            default:
                return true;
        }
    }

    public function index()
    {
        $posts = $this->ArticleModel->find('all');
        $this->set(compact('posts'));

        $this->render('/Dashboard/Post/index');
    }

    public function addPost()
    {
        if ($this->request->is('post')) {
            $this->ArticleModel->create();
            $data = $this->request->data;

            $postData = array(
                'title' => $data['title'],
                'content' => $data['content'],
                'published' => $data['published'],
                'author_id' => $this->currentUser['id']
            );

            if ($this->ArticleModel->save($postData)) {
                $this->Session->setFlash(__('Create post successfully'));

                $this->redirect(array('controller' => 'post', 'action' => 'index'));
            } else {
                if (count($this->ArticleModel->validationErrors) > 0) {
                    $errorMessage = array_values($this->ArticleModel->validationErrors)[0][0];
                    $this->Session->setFlash(__($errorMessage));
                } else {
                    $this->Session->setFlash(__('Cannot add post'));
                }
            }
        }

        $this->render('/Dashboard/Post/add');
    }

    public function publishPost($id)
    {
        $post = $this->ArticleModel->findById($id);
        $postData = array(
            'published' => 1
        );
        $msg = 'Publish post successfully';

        if ($post['ArticleModel']['published']) {
            $postData = array(
                'published' => 0,
                'updated_time' => date('Y-m-d H:i:s')
            );
            $msg = 'Draft post successfully';
        }

        $this->ArticleModel->read(null, $id);
        $this->ArticleModel->set($postData);
        $this->ArticleModel->save();

        $this->Session->setFlash(__($msg));
        return $this->redirect(array('controller' => 'post', 'action' => 'index'));
    }

    public function editPost($id)
    {
        $article = $this->ArticleModel->findById($id);
        if (!$article) {
            throw new NotFoundException(__('Post not found'));
        }

        if ($this->request->is('post')) {
            if (!$id) {
                throw new NotFoundException(__('Please provide valid ID'));
            }

            $data = $this->request->data;
            $postData = array(
                'title' => $data['title'],
                'content' => $data['content'],
                'updated_time' => date('Y-m-d H:i:s')
            );

            $this->ArticleModel->read(null, $id);
            $this->ArticleModel->set($postData);

            if ($this->ArticleModel->save()) {
                $this->Session->setFlash(__('Update post successfully'));

                return $this->redirect(array('controller' => 'post', 'action' => 'index'));
            } else {
                if (count($this->ArticleModel->validationErrors) > 0) {
                    $errorMessage = array_values($this->ArticleModel->validationErrors)[0][0];
                    $this->Session->setFlash(__($errorMessage));
                } else {
                    $this->Session->setFlash(__('Cannot update post'));
                }
            }

        }

        $this->set(compact('article'));
        $this->render('/Dashboard/Post/edit');
    }

    public function deletePost($id)
    {
        $this->ArticleModel->delete($id);
        $this->Session->setFlash(__('Delete post successfully'));
        $this->redirect(array('controller' => 'post', 'action' => 'index'));
    }

    public function home()
    {
        
        $newest = $this->ArticleModel->find('all', array(
            'conditions' => array('ArticleModel.published' => 1),
            'limit' => 10));
        $posts = $this->ArticleModel->find('all', array(
            'conditions' => array('ArticleModel.published' => 1)));

        $this->set(compact('posts', 'newest'));
        $this->layout = 'blog';
        $this->render('/Pages/home');
    }

    public function singlePost($id)
    {
        if (!$id) {
            throw new NotFoundException(__('Please provide valid ID'));
        }

        $article = $this->ArticleModel->findById($id);
        if (!$article) {
            throw new NotFoundException(__('Post not found'));
        }

        $post = $article['ArticleModel'];
        $creator = $article['User'];
        $this->layout = 'blog';
        $newest = $this->ArticleModel->find('all', array(
            'conditions' => array('ArticleModel.published' => 1),
            'limit' => 10));

        $this->set(compact('post', 'newest', 'creator'));
        $this->render('/Pages/single_post');
    }

}