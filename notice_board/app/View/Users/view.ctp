<h3>ユーザーページ</h3>

<Div Align = "right"><h3><?php echo $this->Html->link('管理画面へ', array('action' => 'administrator')); ?></h3>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="span12 well">
                <center>
                    <h3><?php echo h($users['username']);?></h3>
                    <h5>登録：<?php echo h($users['created']);?></h5>
                </center>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="span6">
                <h3>スレッド作成履歴</h3>
                スレッド作成：<?php echo h($posts_count);?>件
                <table class="table">
                    <tr>
                        <th>スレッドNo.</th>
                        <th>タイトル</th>
                        <th>スレッド作成日</th>
                    </tr>
                    <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?php echo h($post['Post']['id']);?></td>
                        <td><?php echo h($post['Post']['title']);?></td>
                        <td><?php echo h($post['Post']['created']);?></td>
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="span6">
                <h3>レスポンス履歴</h3>
                レスポンス：<?php echo h($entries_count);?>回
                <table class="table">
                    <tr>
                        <th>レスポンスNo.</th>
                        <th>レスポンス内容</th>
                        <th>レスポンス投稿日</th>
                    </tr>
                    <?php foreach ($entries as $entry):?>
                    <tr>
                        <td><?php echo h($entry['Entry']['id']);?></td>
                        <td><?php echo h($entry['Entry']['body']);?></td>
                        <td><?php echo h($entry['Entry']['created']);?></td>
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>