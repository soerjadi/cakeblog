<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UserModel extends AppModel {
    public $useTable = 'users';

    public $validate = array(
        'username'  => array(
            'require' => array(
                'required' => true,
                'rule' => array('notBlank', 'isUnique'),
                'message' => 'Username is required',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('lengthBetween', 3, 25),
                'message' => 'Username min 3 and max 25 characters',
            )
        ),
        'name' => array(
            'required' => true,
            'rule' => array('notBlank'),
            'message' => 'Please fill the Name',
            'allowEmpty' => false
        ),
        'email'    => array(
            'required' => true,
            'rule' => array('notBlank', 'isUnique'),
            'message' => 'Please fill the Email',
            'allowEmpty' => false
        ),
        'password' => array(
            'require' => array(
                'required' => true,
                'rule' => array('notBlank'),
                'message' => 'Please fill the Password',
                'allowEmpty' => false
            ),
            'between' => array(
                'rule' => array('minLength', 12),
                'message' => 'Password minimum 12 characters',
            ),
            'passwordConfirmation' => array(
                'rule' => array('passwordConfirm'),
                'message' => 'Password confirmation must be match'
            )
        )
    );

    var $hasMany = array(
        'Article' => array('className' => 'ArticleModel', 'foreignKey' => 'author_id')
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    public function passwordConfirm()
    {
        return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_confirmation'];
    }
}