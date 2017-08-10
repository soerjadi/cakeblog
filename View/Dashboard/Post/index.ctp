<div class="clearfix">
    <?php
    echo $this->Html->link('Add Post',
        array('controller' => 'post', 'action' => 'addPost', 'full_base' => true),
        array('class' => 'btn btn-info'));
    ?>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Author</th>
                <th>Published</th>
                <th>Creation Time</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($posts) > 0) { ?>
                <?php foreach($posts as $key => $_post) : 
                $post = $_post['ArticleModel'];
                ?>
            <tr>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $_post['User']['name']; ?></td>
                <td><?php 
                    if ($post['published']) {
                        echo 'Published';
                    } else {
                        echo 'Not published';
                    }
                ?></td>
                <td><?php echo $post['creation_time']; ?></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Action
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <?php if (!$post['published']) : ?>
                            <li><?php echo $this->Html->link('Publish', array('controller' => 'post', 'action' => 'publishPost', 'id' => $post['id'])); ?></li>
                            <?php else : ?>
                            <li><?php echo $this->Html->link('Draft', array('controller' => 'post', 'action' => 'publishPost', 'id' => $post['id'])); ?></li>
                            <?php endif; ?>
                            <li><?php echo $this->Html->link("Edit", array("controller" => "post", "action" => "editPost", "id" => $post['id'])); ?></li>
                            <li><?php echo $this->Html->link("Delete", array("controller" => "post", "action" => "deletePost", "id" => $post['id'])); ?>                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
                <?php endforeach; ?>
            <?php } else { ?> 
            <tr>
                <td colspan='5'>Post is still empty</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>