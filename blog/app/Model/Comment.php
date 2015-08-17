<?php

class Comment extends AppModel {
	public $belongsTo = 'Post'; //$hasMany と紐づく
}