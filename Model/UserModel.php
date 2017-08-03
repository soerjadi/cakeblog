<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class UserModel extends AppModel {
    public $name = 'users';

    public $validate = array(
        'username'  => array(
            'required' => array (
                'rule' => 'notBlank',
                'message' => 'Username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Password is required'
            )
        ),
        'email'    => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'Email is required'
            )
        )
    );

    var $hasMany = array(
        'Article' => array('className' => 'Article')
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
}