 <!-- Indexはトップ画面のこと -->

<h2>記事一覧</h2>

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

<h2>Add Post</h2>
<?php echo $this->Html->link('Add post', array('controller'=>'Posts', 'action'=>'add'));

?>

<script> //jqueryのスクリプトを直接書いていく
$(function(){
	$('a.delete').click(function(e) { //a要素のdeleteクラスのついたもの(削除用リンク)をクリックした時に次のことをしなさい。
		if (confirm('Sure!?')) { //一応confirm
			$.post('/blog/posts/delete/' +$(this).data('post-id'), {}, function(res) { //postの飛び先が、'/blog/posts/delete/'  {} は渡すパラメータがないのでこれでいい。 帰ってきた値は"json"
				$('#post_' +res.id).fadeOut(); //帰ってきた値に対して表現処理(fadeOut)
			}, "json");
		}
		return false;
	});
});

</script>