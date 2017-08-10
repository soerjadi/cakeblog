<?php if(count($posts) > 0) : ?>
    <?php foreach($posts as $_post) : 
        $post = $_post['ArticleModel'];
    ?>
        <div class="blog-post">
            <h2 class="blog-post-title"><?php echo $this->Html->link($post['title'], array('controller' => 'post', 'action' => 'singlePost', 'id' => $post['id'])); ?></h2>
            <p><?php echo date('F d, Y', strtotime($post['creation_time'])) . " by " . $_post['User']['name']; ?></p>
            <p><?php echo $post['content']; ?></p>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    There is no post yet
<?php endif; ?>