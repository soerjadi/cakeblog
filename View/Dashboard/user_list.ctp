<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>&nbsp;</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($users as $key => $user) : 
                $_user = $user['User'];
            ?>
            <tr>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $_user['username'] ?></td>
                <td><?php echo $_user['name'] ?></td>
                <td><?php echo $_user['email'] ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li>
                            <?php echo $this->Html->link("Edit", array("controller" => "dashboard", "action" => "editUser", "id" => $_user['id'])); ?>
                            </li>
                            <?php if ($_user['id'] != $currentUser['id']) : ?>
                            <li>
                            <?php echo $this->Html->link("Delete", array("controller" => "dashboard", "action" => "deleteUser", "id" => $_user['id'])); ?>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>