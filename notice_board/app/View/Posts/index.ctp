<!-- Indexはトップ画面のこと -->

<div class = "row-fluid">
	<div class = "span9">

		<Div Align = "right"><h5><?php echo $this->Html->link('ユーザーページヘ', array('controller' => 'Users', 'action' => '/view')); ?></h5></Div>

		<Div Align = "right"><h5><?php echo $this->Html->link('管理画面へ', array('controller' => 'Users', 'action' => 'administrator')); ?></h5></Div>

		<h4>ようこそ <?php echo h($users['username']);?> さん</h4>

		<h4><?php echo $this->Html->link('スレッド新規作成', array('action' => 'add')); ?></h4>

		<?php echo $this->Paginator->counter(array('format' => ('スレッド数 : {:count}'))); ?>
		<!-- スレッド数を表示する。実際に何件あるかは array('formet' => ('threads: {:count}')) この配列でOK-->

			<table class = "table">
				<tr>
					<th><?php echo $this->Paginator->sort('id', 'No.'); ?></th>
					<th><?php echo $this->Paginator->sort('title', 'タイトル'); ?></th>
					<th><?php echo $this->Paginator->sort('username','スレッド作成ユーザ');?></th>
					<th><?php echo $this->Paginator->sort('created', 'スレッド作成日'); ?></th>
				</tr>
			<!-- <th></th>はテーブルのヘッダー。  このPaginatorはなぜ？？-->


				<dev class = "auto-paging">
				<?php foreach ($posts as $rows): ?>　<!-- ぐるぐる回すところ -->

				<tr> 
				<!-- 上で作ったヘッダーに合うようにデータのテーブルも作っていく。（タイトルとユーザーはそれぞれの詳細ページに飛べるようにリンクを付けておく。） -->
					<td><?php echo h($rows['Post']['id']); ?></td>
					<td><?php echo $this->Html->link($rows['Post']['title'], array('action' => 'view', $rows['Post']['id'])); ?></td>
					<!-- Htmlヘルパー(PostsControllerで準備した)を使って、簡単にリンクを作れるようになる。
					echo $this->Html->link(リンクテキスト, リンク先); -->
					<td><?php echo $this->Html->link($users['username'],
					array('controller' => 'Users','action' => 'view'));?></td>

					<td><?php echo h($rows['Post']['created']); ?></td>
					<!-- h()の中に入れることでエスケープする。 h は、cakephpが用意しているhtml special characters というエスケープを表す。-->
				</tr>

				<?php endforeach; ?>
				</dev>
			</table>

		<!-- ページネーションの作成 -->
		<div style="display:none">
			<?php echo $this->Paginator->next('Next'); ?>
		</div>

		<?php
		  echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/1.10.3/jquery.min.js');
		  echo $this->Html->script('jquery.autopager-1.0.0');
		?>
		<script type="text/javascript">
		    $(function() {
		        $.autopager({
		          content : '.auto-paging'
		        });
		    });
		</script>

		<!-- ログアウトリンクの作成 -->
		<?php echo $this->Html->link('ログアウト', '/users/logout'); ?>
	</div>

	<!-- キーワード検索機能の作成 -->
	<div class = "span3">
		<div class = "well" style = "margin-top: 20px;">
			<?php echo $this->Form->create('Post', array('action' => 'index')); ?>
				<fieldset>
					<legend>検索</legend>
					<?php echo $this->Form->input('keyword', array('class' => 'span12', 'placeholder' => '検索ワード入力')); ?>
				</fieldset>
			<?php echo $this->Form->end('検索'); ?>
		</div>
	</div>
</div>