<?php 
echo $this->Flash->render('auth');
echo $this->Form->create(false, array(
    "url" => array("controller" => "post", "action" => "addPost"),
    "type" => "post")
    ); 
    echo $this->Form->input('title');
    echo $this->Form->input('content', array('type' => 'textarea'));
    echo $this->Form->input('published', array('type' => 'checkbox', 'style' => 'margin-left: 0px !important;'));
?>

<?php echo $this->Form->end("Save Post"); ?>