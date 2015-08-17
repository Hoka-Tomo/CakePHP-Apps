<h2>ユーザー新規登録</h2>

<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User');
	echo $this->Form->input('User.username', array('label' => 'ユーザー名'));
	echo $this->Form->input('User.password', array('label' => 'パスワード'));
	echo $this->Form->end('新規作成');
	echo $this->Html->link('ログイン', 'login');