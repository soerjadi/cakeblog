<?php 
echo $this->Flash->render('auth');
$_user = $user['UserModel'];
echo $this->Form->create(false, array(
    "url" => array("controller" => "dashboard", "action" => "editUser", "id" => $_user['id']),
    "type" => "post")
    ); 
    echo $this->Form->input('username', array('value' => $_user['username']));
    echo $this->Form->input('name', array('value' => $_user['name']));
    echo $this->Form->input('email', array('value' => $_user['email']));
    echo $this->Form->input('password');
    echo $this->Form->input('password_confirmation', array('type' => 'password'));
?>

<?php echo $this->Form->end("Save User"); ?>