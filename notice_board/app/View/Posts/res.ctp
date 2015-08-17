<h2>レス作成</h2>

<?php echo $this->Html->link('スレッドに戻る', array('controller' => 'Posts', 'action' => 'view', $id));
echo $this->Form->create('Entry', array('type' => 'post'));
echo $this->Form->input('Entry.body', array('type' => 'textarea', 'label' => '内容'));
echo $this->Form->end('書き込み');