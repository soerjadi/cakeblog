<?php 
echo $this->Flash->render('auth');
echo $this->Form->create(false, array(
    "url" => array("controller" => "dashboard", "action" => "userAdd"),
    "type" => "post")
    ); 
    echo $this->Form->input('username');
    echo $this->Form->input('name');
    echo $this->Form->input('email');
    echo $this->Form->input('password');
    echo $this->Form->input('password_confirmation', array('type' => 'password'));
    ?>

<?php echo $this->Form->end("Save User"); ?>