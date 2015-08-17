<h2>スレッド内容</h2>

<?php
echo $this->Form->create('Post', array('type' => 'post')); //Formのヘルパー Formの始まりはcreate('モデル名');
echo $this->Form->input('Post.title', array('label' => 'タイトル'));
echo $this->Form->input('Post.body', array('type' => 'textarea', 'label' => '本文', 'rows' => 3)); //配列でhtmlの属性を入れることもできる！ 'rows'テキストエリアの行数を3行にしてみた。
echo $this->Form->end('作成!');

//これだけでフォームができる！！