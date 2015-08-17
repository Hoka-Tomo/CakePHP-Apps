<h2>管理者ログイン</h2>

<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User', array('url', 'admin/login'));
	echo $this->Form->input('User.username', array('label' => 'ユーザー名'));
	echo $this->Form->input('User.password', array('type' => 'password', 'label' => 'パスワード'));
	echo $this->Form->end('ログイン');