<?php
/**
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 */

$cakeDescription = __d('cake_dev', 'Simple Blog with CakePHP');
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
    <link href="http://getbootstrap.com/examples/blog/blog.css" rel="stylesheet">
</head>
<body>
    <div class="blog-masthead">
        <div class="container">
            <nav class="blog-nav">
                <?php echo $this->Html->link("Home", 
                    array("controller" => "post", "action" => "home"),
                    array("class" => "blog-nav-item")); ?>
                <?php if ($isLoggedIn) { 
                    echo $this->Html->link("Dashboard", 
                        array("controller" => "dashboard", "action" => "index"), 
                        array("class" => "blog-nav-item")); 
                    echo $this->Html->link("Logout", 
                        array("controller" => "auth", "action" => "logout"), 
                        array("class" => "blog-nav-item")); 
				} else {
					echo $this->Html->link("Login", 
						array("controller" => "auth", "action" => "index"),
						array("class" => "blog-nav-item"));
				} ?>
            </nav>
        </div>
    </div>

	<div class="container">
		<div class="blog-header">
			<h1 class="blog-title">The CakeBlog</h1>
			<p class="lead blog-description">Example blog with CakePHP, Templating by Bootstrap.</p>
		</div>
		<div class="row">
				<div class="col-md-8 blog-main">
					<?php echo $this->fetch('content'); ?>
				</div>
				<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
					<div class="sidebar-module">
						<h4>Latest</h4>
						<ol class="list-unstyled">
						<?php foreach($newest as $_newPost) :
							$newPost = $_newPost['ArticleModel'];
						?>
							<li><?php echo $this->Html->link($newPost['title'], array('controller' => 'post', 'action' => 'singlePost', 'id' => $newPost['id'])); ?></li>
						<?php endforeach; ?>
						</ol>
					</div>
				</div>
		</div>		
		
	</div>

	<?php
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
	?>
</body>
</html>
