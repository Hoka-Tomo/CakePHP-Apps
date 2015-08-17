<?php
 
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher','Controller/Component/Auth');
 
class User extends AppModel {
    public $name = 'User';
    public $hasMany = array('Post','Entry');
    
    //保存前にパスワードのハッシュ化
    public function beforeSave($options = array()) {
        if(!$this->id){
            $passwordHasher = new SimplePasswordHasher();
            $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
        }
        return true;
    }
 
    //バリデーション
    public $validate = array(
        'username' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => '必須入力です',
                'required' => true,
            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => '半角英数字のみ入力してください',
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'このユーザ名は既に登録されています'
            ),
        ),
        'password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => '必須入力です',
                'required' => true,
            ),
            'alphaNumeric' => array(
                'rule' => array('alphaNumeric'),
                'message' => '半角英数字のみ入力してください',
            ),
        ),
    );
    
    //alphaNumericの日本語対策
    public function alphaNumeric($check){
        $value = array_values($check);
        $value = $value[0];
        return preg_match('/^[a-zA-Z0-9]+$/', $value);
    }
}