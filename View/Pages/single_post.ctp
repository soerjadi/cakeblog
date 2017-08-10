<div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post['title']; ?></h2>
    <p><?php echo date('F d, Y', strtotime($post['creation_time'])) . " by " . $creator['name']; ?></p>
    <p><?php echo $post['content']; ?></p>
</div>