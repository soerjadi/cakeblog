<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'Dashboard');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('bootstrap.min');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
    <link href='http://getbootstrap.com/examples/dashboard/dashboard.css' rel="stylesheet" />
</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <?php 
                    echo $this->Html->link("CakeBlog", 
                        array("controller" => "post", "action" => "home"),
                        array("class" => "navbar-brand"));
                ?>
            </div>
      </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar">
                    <li><?php
                        echo $this->Html->link('Dashboard', array(
                            'controller' => 'dashboard',
                            'action'     => 'index',
                            'full_base'  => true
                        ));
                    ?></li>
                    <li><?php
                        if ($currentUser['role'] == 0) {
                            echo $this->Html->link('Users', array(
                            'controller'    => 'dashboard',
                            'action'        => 'userList',
                            'full_base'     => true
                        ));
                        }
                    ?></li>
                    <li><?php 
                        echo $this->Html->link('Posts', array(
                            'controller'    => 'post',
                            'action'        => 'index',
                            'full_base'     => true
                        ));
                    ?></li>
                    <li><?php
                        echo $this->Html->link('Logout', array(
                            'controller'    => 'auth',
                            'action'        => 'logout',
                            'full_base'     => true
                        ));
                    ?></li>
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Dashboard</h1>

                <?php echo $this->Session->flash(); ?>

                <?php echo $this->fetch('content'); ?>
            
            </div>
        </div>
    </div>

	<?php
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
	?>
</body>
</html>
