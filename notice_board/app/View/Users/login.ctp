<div class="login form">

<h2>ユーザーログイン</h2>

<?php
	echo $this->Session->flash('auth');
	echo $this->Form->create('User', array('url', 'login'));
	echo $this->Form->input('User.username', array('label' => 'ユーザー名'));
	echo $this->Form->input('User.password', array('type' => 'password', 'label' => 'パスワード'));
	echo $this->Form->end('ログイン');
	echo $this->Html->link('新規作成', 'useradd');
?>

</div>