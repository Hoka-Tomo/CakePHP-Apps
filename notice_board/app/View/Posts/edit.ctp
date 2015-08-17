<h2>編集フォーム</h2>

<?php
echo $this->Form->create('Post', array('action' =>'edit')); //Postに関するもので、行き先がedit
echo $this->Form->input('title'); //インプットタグ
echo $this->Form->input('body', array('rows'=>3)); //インプットタグ 行は３列に指定
echo $this->Form->end('保存!');




<? php
	echo $this->Form->create(false,array('type'=>'post', array('action'=>'edit')));
	echo $this->Form->hidden('Board.id');
	echo $this->Form->hidden('Board.personal_id');
	echo $this->Form->hidden('Personal.id');
	echo $this->Form->hidden('Personal.username');
	echo "名前：{$data['Personal']['username']}<br /><br />";
	echo "パスワード：{$this->Form->password('Personal.password')}";
	echo $this->Form->error('Personal.password');
	echo "タイトル：{$this->Form->text('Board.title')}";
	echo $this->Form->error('Board.title');
	echo "内容：{$this->Form->textarea('Board.content')}";
	echo $this->Form->end('送信');