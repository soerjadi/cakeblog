<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    protected $currentUser;
    protected $isLoggedIn;
    
    public $components = array(
        'DebugKit.Toolbar',
        'Flash',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'dashboard',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'loginAction' => array(
                'controller' => 'auth',
                'action' => 'index'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
            'authorize' => array('Controller')
        )
    );

    public $helpers = array('Html', 'Form', 'Session');

    public function beforeFilter() 
    {
        $this->Auth->allow('display', 'view');
        $this->currentUser = $this->Auth->user();
        $this->isLoggedIn = isset($this->currentUser);
    }

    public function isAuthorized() 
    {
        return true;
    }

    public function updateLastLogin($id)
    {
        $this->loadModel("UserModel");
        $user = $this->UserModel->findById($id)["UserModel"];

        $now = date("Y-m-d H:i:s");
        $lastLoginOld = $user["last_login_old"];

        $data = array(
            "last_login" => $now,
            "last_login_old" => $lastLoginOld
        );

        $this->UserModel->read(null, $user['id']);
        $this->UserModel->set($data);
        $this->UserModel->save();
    }
}
