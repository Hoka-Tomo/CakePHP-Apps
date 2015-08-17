<?php

App::uses('AppModel', 'Model');

class Entry extends Appmodel {
	public $name = 'Entry';
	public $validate = array (
		'body' => array(
			'rule' => array('maxlength', 255),
			'required' => true,
			'allowEmpty' => false,
			'message' => 'レスポンスは255文字以下で入力して下さい'
		)
	);
	public $belongsTo = array('User'); //なんで array 使ってるの？？
	//public $hasMany = 'Comment'; //belongsTo と紐づく！
	// Post を引っ張ってくると紐付いたCommentも引っ張れる。
}