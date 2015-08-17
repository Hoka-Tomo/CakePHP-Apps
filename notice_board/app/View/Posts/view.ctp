<h3>
<?php echo h($post_data['Post']['id']); ?>

<?php echo h($post_data['Post']['title']); ?>
</h3>

<h4>このスレッド閲覧数 : <?php echo h($uses['Count']['count'])  ?> 回</h4> <!-- スレッド閲覧数 -->

<div style="border-style:double;border-width:1px;padding:10px 5px 10px 20px;">
<h5>投稿日時 : </h5><?php echo h($post_data['Post']['created']); ?>

<h5>投稿者 : </h5><?php echo h($post_data['Post']['user_id']); ?> <!-- エラー！！ -->

<h5>内容 : </h5><?php echo h($post_data['Post']['body']); ?>
<!-- 変数postのDBであるPostのtitle, bodyを取り出す！
h は、cakephpが用意しているhtml special characters というエスケープを表す。 -->
</div>



<ul>
	<?php foreach ($entry_data as $rows): ?> 
	<!-- foreach は配列の反復処理！ -->
		<li>
		<?php echo h($rows['Entry']['body']); ?>
		</li>
		<p>
		<?php echo h($rows['Entry']['created']); ?>
		<?php echo h($rows['User']['username']); ?>
		</p>

	<?php endforeach; ?>
</ul>

<?php echo $this->Html->link('書き込み', 'res/'.$post_data['Post']['id'], array('class' => 'button')); ?>