<?php 
$post = $article['ArticleModel'];
echo $this->Flash->render('auth');
echo $this->Form->create(false, array(
    "url" => array("controller" => "post", "action" => "editPost", "id" => $post['id']),
    "type" => "post")
    ); 
    echo $this->Form->input('title', array('value' => $post['title']));
    echo $this->Form->input('content', array('type' => 'textarea', 'value' => $post['content']));
?>

<?php echo $this->Form->end("Save Post"); ?>