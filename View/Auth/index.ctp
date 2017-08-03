<div class="col-md-4"></div>
<div class="col-md-4">
    <h3>Login</h3>
    <?php echo $this->Flash->render('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
        <fieldset>
            <?php 
                echo $this->Form->input('username');
                echo $this->Form->input('password');
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Login')); ?>
</div>
<div class="col-md-4"></div>