<?php

class Post extends AppModel {
	public $hasMany = 'Comment'; //belongsTo と紐づく！
	// Post を引っ張ってくると紐付いたCommentも引っ張れる。
	
	// エラーチェック・・・モデルにバリデーションを書く！！
	public $validate = array( //入力必須ならこう書く。
		'title' => array(
			'rule' => 'notEmpty',
			'message' => '何か入力してくださいな！' //message も付けられる。
		),
		'body' => array(
			'rule' => 'notEmpty',
			'message' => '何か入力してくださいな！'
		)
	);
}