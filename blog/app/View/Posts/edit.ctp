<h2>Edit Post</h2>

<?php
echo $this->Form->create('Post', array('action' =>'edit')); //Postに関するもので、行き先がedit
echo $this->Form->input('title'); //インプットタグ
echo $this->Form->input('body', array('rows'=>3)); //インプットタグ 行は３列に指定
echo $this->Form->end('Save!');