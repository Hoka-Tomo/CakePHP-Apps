<?php

App::uses('AppModel', 'Model');

class Post extends AppModel {
	public $name = 'Post';
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'keyword' => array('type' => 'like', 'field' => array('Post.title', 'Post.body', 'User.username'))
	);
	public $validate = array( //入力必須ならこう書く。
		'title' => array(
			'rule' => array('maxlength', 100),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'スレッドのタイトルは100文字以下で入力して下さい' //message も付けられる。
		),
		'body' => array(
			'rule' => array('maxlength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'スレッドの内容は255文字以下で入力して下さい'
		)
	);

	//後でやります。

// 	public $belongsTo = array(
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>'User' => array(
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>'className' => 'User',
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>'foreignKey' => 'user_id',
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>'conditions' => '',
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>'fields' => '',
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>'order' => ''
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>)
// <span class = "Apple-tab-span" style = "white-space: pre;"></span>);
    public $hasMany = array('Entry');
}
