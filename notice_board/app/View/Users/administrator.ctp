<h3><?php echo h($users['username']); ?> さんの管理者用ページです</h3>

<div Align = "right"><h4><?php echo $this->Html->link('ユーザーページヘ', array('controller' => 'Users', 'action' => '/view')); ?></h4></div>

<div class="row">
        <div class="col-md-6">
            <div class="span6">
                <h3>スレッド作成履歴</h3>
                スレッド作成：<?php echo h($posts_count);?> 件
                <table class="table">
                    <tr>
                        <th>スレッドNo.</th>
                        <th>タイトル</th>
                        <th>スレッド作成日</th>
                    </tr>
                    <?php foreach ($posts as $post):?>
                    <tr>
                        <td><?php echo h($post['Post']['id']);?></td>
                        <td><?php echo h($post['Post']['title']);?></td>
                        <td><?php echo h($post['Post']['created']);?></td>
                        <td><?php echo $this->Html->link(['編集'], array('action' => 'edit'))?>;</td>
                    <?php endforeach ;?>
                    </tr>
                </table>
            </div>
        </div>
</div>