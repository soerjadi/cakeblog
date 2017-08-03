<?php

App::uses("AppModel", "Model");

class Article extends AppModel {
    var $name = "article";

    public $belongTo = array(
        'User' => array('className' => 'User')
    );
}