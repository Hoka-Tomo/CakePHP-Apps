<?php
class CommentsController extends AppController {
	public $helpers = array('Html', 'Form');
	//'Html'と'Form'に関するヘルパーを呼び出しなさい！


	public function add() { //add のアクションを加える！
		if ($this->request->is('post')) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash('Success!'); //「成功」と表示
				$this->redirect(array('controller'=>'posts', 'action'=>'view', $this->data['Comment']['post_id'])); // リダイレクト処理 redirect('/'); でもうまくいくが、配列でコントローラーアクションを展開することができる。(今回コントローラーは同じなので、アクションだけ指定してあげる)
				//'action'=>'index'にすると、Commentsのindexに来てしまうので、まず、controllerをpostsにし、actionはviewに、記事のidを渡さないといけないので、$this->data['Comment']['post_id'] こうする。
			} else {
				$this->Session->setFlash('failed!'); //「失敗」と表示
			}
		}
	}

	

	public function delete($id) {
		if ($this->request->is('get')) { //'get'でアクセスしてきたら、'例外'を返せ！！
			throw new MethodNotAllowedException(); //エラー
		}
		// if ($this->Post->delete($id)) {
		// 	$this->Session->setFlash('Deleted!!');
		// 	$this->redirect(array('action' => "index"));

		if ($this->request->is('ajax')) { //ajaxかどうか？
			if ($this->Comment->delete($id)) { //データの削除を試みて、うまく行ったか行かなかったか
				$this->autoRender = false; //どっちも機能させない(勝手に書かせないため)
				$this->autoLayout = false;
				$response = array('id' => $id); //idをjson形式で返す
				$this->header('Content-Type: application/json');
				echo json_encode($response);
				exit();
			}
		}
		$this->redirect(array('controller'=>'posts', 'action'=>'index')); //ajaxじゃない場合(例外処理)
		//そのまま $this->redirect(array(action'=>'index')); だと、commentのインデックスに行ってしまうので、'controller'=>'posts' でpostsコントローラーに飛ばす。
	}
}