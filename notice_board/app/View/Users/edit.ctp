<h2>編集フォーム</h2>

<?php
// echo $this->Form->create('Post', array('action' =>'edit')); //Postに関するもので、行き先がedit
// echo $this->Form->input('title'); //インプットタグ
// echo $this->Form->input('body', array('rows'=>3)); //インプットタグ 行は３列に指定
// echo $this->Form->end('保存!');




	echo $this->Form->create(false,array('type'=>'post', array('action'=>'edit')));
	echo $this->Form->hidden('User.id');
	echo $this->Form->hidden('Post.user_id');
	echo $this->Form->hidden('User.id');
	echo $this->Form->hidden('User.username'); ?>


	<h3><?php echo h($users['username']);?> さん</h3>

	<?php echo h($post_data['Post']['id']); ?>
	<?php echo h($post_data['Post']['title']); ?>
	




<?php

	echo "パスワード：{$this->Form->password('User.password')}";
	echo $this->Form->error('User.password');

	// echo "タイトル：{$this->Form->text('Post.title')}";
	// echo $this->Form->error('Post.title');

	echo "内容：{$this->Form->textarea('Post.body')}";
	echo $this->Form->end('送信'); ?>

	<ul>
	<?php foreach ($posts as $post) : ?>
		<li id="post_<?php echo h($post['Post']['id']); ?>"> 
		<!-- 記事を一覧から消すときに<li>にidをつけてあげる。phpで書き、h()の中に入れることでエスケープする。 -->
			<?php
			//debug($post); //今何が走っているのかを確認できる
			//echo h($post['Post']['title']);
			//変数postのDBであるPostのtitleを取り出す！
			//h は、cakephpが用意しているhtml special characters というエスケープを表す。

			echo $this->Html->link(($post['Post']['title']), '/posts/view/'.$post['Post']['id']);
			//Htmlヘルパー(PostsControllerで準備した)を使って、簡単にリンクを作れるようになる。
			//echo $this->Html->link(リンクテキスト, リンク先);
			?>
			<?php echo $this->Html->link('編集', array('action'=>'edit', $post['Post']['id'])); ?> 
<!-- 			linkテキストが'編集', 行き先edit, id の順 -->
			<?php
				// echo $this->Form->postLink('削除', array('action' => 'delete', $post['Post']['id']), array('confirm' => 'sure?'));
				//'confirm' は確認メッセージを表示

				echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-post-id'=>$post['Post']['id']));
					//飛び先'#'でOK 'delete'クラスをつけて、jqueryで拾うようにする。 idはデータ属性を指定。idは、$post['Post']['id']
			?>
		</li>
	<?php endforeach; ?>

</ul>
