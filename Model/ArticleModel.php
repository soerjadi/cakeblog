<?php

App::uses("AppModel", "Model");

class ArticleModel extends AppModel {
    public $name = "article";
    public $table = 'article';
    public $useTable = 'article';

    public $validate = array(
        'title' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Please fill the Title'
            ),
            'length' => array(
                'rule' => array('lengthBetween', 3, 160),
                'message' => 'Title min 3 and max 160 characters'
            )
        ),
        'content' => array(
            'notEmpty' => array(
                'rule' => array('notBlank'),
                'required' => true,
                'allowEmpty' => false,
                'message' => 'Please fill the Content'
            ),
            'length' => array(
                'rule' => array('minLength', 3),
                'message' => 'Content minimal 3 characters'
            )
        )
    );

    public $belongsTo = array(
        'User' => array(
            'className' => 'UserModel', 
            'foreignKey' => 'author_id',
            'fields' => array('id', 'name', 'username', 'email'))
    );
}