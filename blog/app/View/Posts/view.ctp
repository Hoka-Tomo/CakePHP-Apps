<h2><?php echo h($post['Post']['title']); ?></h2>

<p><?php echo h($post['Post']['body']); ?></p>

<!-- 変数postのDBであるPostのtitle, bodyを取り出す！
h は、cakephpが用意しているhtml special characters というエスケープを表す。 -->

<h2>Comments</h2>

<ul>
<?php foreach ($post['Comment'] as $comment): ?> 
<!-- postからcommentも引っ張ってこれるのでこう書ける。 foreach は配列の反復処理！ -->
<li id="comment_<?php echo h($comment['id']); ?>">
<?php echo h($comment['body'])?> by <?php echo h($comment['commenter']); ?>
<!-- 表示されるとき、'コメント本文 by commenter' と表示される処理 -->
<?php 
	echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-comment-id'=>$comment['id'])); ?>
</li>
<?php endforeach;?>
</ul>

<h2>Add Comment</h2>

<!-- フォームを作る！！ -->
<?php
echo $this->Form->create('Comment', array('action'=>'add')); //コメントに関するもの
echo $this->Form->input('commenter'); //第１のフィールド 'コメンター'
echo $this->Form->input('body', array('rows'=>3)); //第２のフィールド '本文'(今回は３行にする)
echo $this->Form->input('Comment.post_id', array('type'=>'hidden', 'value'=>$post['Post']['id'])); //コメントのpost_idを渡さないと何のポストに関してのものかわからなくなるので。'Comment.post_id' こう書く。　'type'=>'hidden'は非表示データの送信
//inputはフォームの構成部品を作成するタグ
//createはフォームヘルパーの開始タグを作る

echo $this->Form->end('post comment');

?>

<script> //jqueryのスクリプトを直接書いていく
$(function(){
	$('a.delete').click(function(e) { //a要素のdeleteクラスのついたもの(削除用リンク)をクリックした時に次のことをしなさい。
		if (confirm('Sure!?')) { //一応confirm
			$.post('/blog/comments/delete/' +$(this).data('comment-id'), {}, function(res) { //postの飛び先が、'/blog/comments/delete/'  {} は渡すパラメータがないのでこれでいい。 帰ってきた値は"json"
				$('#comment_' +res.id).fadeOut(); //帰ってきた値に対して表現処理(fadeOut)
			}, "json");
		}
		return false;
	});
});

</script>