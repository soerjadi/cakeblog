<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 */

/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'post', 'action' => 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
	// Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/auth', array('controller' => 'auth', 'action' => 'index'));
	Router::connect('/logout', array('controller' => 'auth', 'action' => 'logout'));
	Router::connect('/register', array('controller' => 'user', 'action' => 'register'));

	// Router for user administrator
	Router::connect('/dashboard/users', array('controller' => 'dashboard', 'action' => 'userList'));
	Router::connect('/dashboard/users/:id/edit', 
		array('controller' => 'dashboard', 'action' => 'editUser'),
		array('pass' => array('id'), 'id' => '[0-9]+'));
	Router::connect('/dashboard/users/:id/delete',
		array('controller' => 'dashboard', 'action' => 'deleteUser'),
		array('pass' => array('id'), 'id' => '[0-9]+'));
	Router::connect('/dashboard/users/add', array('controller' => 'dashboard', 'action' => 'userAdd'));

	// Router for post administrator
	Router::connect('/dashboard/posts', array('controller' => 'post', 'action' => 'index'));
	Router::connect('/dashboard/posts/add', array('controller' => 'post', 'action' => 'addPost'));
	Router::connect('/dashboard/posts/:id/edit', 
		array('controller' => 'post', 'action' => 'editPost'),
		array('pass' => array('id'), 'id' => '[0-9]+'));
	Router::connect('/dashboard/posts/:id/delete', 
		array('controller' => 'post', 'action' => 'deletePost'),
		array('pass' => array('id'), 'id' => '[0-9]+'));
	Router::connect('/dashboard/posts/:id/publish', 
		array('controller' => 'post', 'action' => 'publishPost'),
		array('pass' => array('id'), 'id' => '[0-9]+'));

	// Router for post
	Router::connect('/post/:id', 
		array('controller' => 'post', 'action' => 'singlePost'),
		array('pass' => array('id'), 'id' => '[0-9]+'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
